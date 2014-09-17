<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:19
 */

use Dreamcommerce\Exceptions\ClientException;
use Dreamcommerce\Exceptions\HandlerException;

require '../vendor/autoload.php';

class SomeApplicationController
{

    /**
     * @var null|Dreamcommerce\Handler
     */
    protected $handler = null;

    /**
     * instantiate connection
     * @return PDO
     */
    protected function getDatabaseConnection()
    {
        static $connection = null;

        if (!$connection) {
            $connection = new PDO('mysql:host=localhost;dbname=app', 'root', '');
        }

        return $connection;
    }

    public function __construct()
    {

        // instantiate a handler
        $handler = $this->handler = new Dreamcommerce\Handler(123, 123);

        // subscribe to particular events
        $handler->subscribe('install', array($this, 'installHandler'));
        $handler->subscribe('billing_install', array($this, 'billingInstallHandler'));
        $handler->subscribe('billing_subscription', array($this, 'billingSubscriptionHandler'));
        $handler->subscribe('uninstall', array($this, 'uninstallHandler'));

    }

    /**
     * dispatches controller
     */
    public function dispatch()
    {
        try {
            $this->handler->dispatch();
        } catch (HandlerException $ex) {
            if ($ex->getCode() == HandlerException::HASH_FAILED) {
                die('Payload hash verification failed');
            }
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    /**
     * install action
     * arguments:
     * - action
     * - shop
     * - shop_url
     * - application_code
     * - auth_code
     * - hash
     * - timestamp
     *
     * @param array $arguments
     */
    public function installHandler($arguments)
    {

        $conn = $this->getDatabaseConnection();

        // shop installation
        $shopStmt = $conn->prepare('INSERT INTO shops (shop, shop_url, auth_code) values (?,?,?)');
        $shopStmt->execute(array(
            $arguments['shop'], $arguments['shop_url'], $arguments['auth_code']
        ));

        $shopId = $conn->lastInsertId();

        // get OAuth tokens
        try {
            $tokens = $arguments['client']->getToken($arguments['auth_code']);
        } catch (ClientException $ex) {
            die('Ooops, something went wrong: ' . $ex->getCode());
        }

        // store tokens in db
        $tokensStmt = $conn->prepare('INSERT INTO access_tokens (shop_id, expires_at, access_token, refresh_token) VALUES (?,?,?,?)');
        $expirationDate = date('Y-m-d H:i:s', time()+$tokens['expires']);
        $tokensStmt->execute(array(
            $shopId, $expirationDate, $tokens['access_token'], $tokens['refresh_token']
        ));

    }

    /**
     * client paid for the app
     * arguments:
     * - action
     * - shop
     * - shop_url
     * - application_code
     * - hash
     * - timestamp
     *
     * @param array $arguments
     */
    public function billingInstallHandler($arguments)
    {

        $shopId = $this->getShopId($arguments['shop']);

        // store payment event
        $conn = $this->getDatabaseConnection();
        $stmt = $conn->prepare('INSERT INTO billings (shop_id) VALUES (?)');
        $stmt->execute(array(
            $shopId
        ));

    }

    /**
     * app is being uninstalled
     * arguments:
     * - action
     * - shop
     * - shop_url
     * - application_code
     * - hash
     * - timestamp
     *
     * @param array $arguments
     */
    public function uninstallHandler($arguments)
    {
        $shopId = $this->getShopId($arguments['shop']);

        $conn = $this->getDatabaseConnection();

        // remove shop's references
        $conn->query('DELETE FROM shops WHERE id='.(int)$shopId);
        $conn->query('DELETE FROM billings WHERE shop_id='.(int)$shopId);
        $conn->query('DELETE FROM subscriptions WHERE shop_id='.(int)$shopId);
        $conn->query('DELETE FROM access_tokens WHERE shop_id='.(int)$shopId);


    }

    /**
     * client paid for a subscription
     * arguments:
     * - action
     * - shop
     * - shop_url
     * - application_code
     * - subscription_end_time
     * - hash
     * - timestamp
     *
     * @param $arguments
     * @throws Exception
     */
    public function billingSubscriptionHandler($arguments)
    {
        $shopId = $this->getShopId($arguments['shop']);

        // make sure we convert timestamp correctly
        $expiresAt = date('Y-m-d H:i:s', strtotime($arguments['subscription_end_time']));

        if(!$expiresAt){
            throw new Exception('Malformed timestamp');
        }

        // save subscription event
        $conn = $this->getDatabaseConnection();
        $stmt = $conn->prepare('INSERT INTO subscriptions (shop_id, expires_at) VALUES (?,?)');
        $stmt->execute(array(
            $shopId, $expiresAt
        ));

    }

    /**
     * helper function for ID finding
     * @param $shop
     * @return string
     */
    protected function getShopId($shop){

        $conn = $this->getDatabaseConnection();
        $stmt = $conn->prepare('SELECT id FROM shops WHERE shop=?');

        $stmt->execute(array(
            $shop
        ));
        $id = $stmt->fetchColumn(0);
        return $id;
    }

}

$controller = new SomeApplicationController();
$controller->dispatch();