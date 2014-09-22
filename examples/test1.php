<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:19
 */

use Dreamcommerce\Exceptions\ClientException;
use Dreamcommerce\Exceptions\HandlerException;

require __DIR__.'/../vendor/autoload.php';

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
            $connection = new PDO('mysql:host=192.168.56.101;dbname=app', 'root', 'dupa.8');
            //$connection = new PDO('mysql:host=localhost;dbname=przemek_sync', 'sync', 'D8Q7jynaNR3AfFnN');
        }

        return $connection;
    }

    /**
     * @throws Exception
     */
    public function __construct()
    {

        try {
            // instantiate a handler
            $handler = $this->handler = new Dreamcommerce\Handler(
                'https://55.dev/webapi/rest/', 'afbbdb69614792d8f0318d55bf33c51f', 'haslo1', 'haslo2'
            );

            // subscribe to particular events
            $handler->subscribe('install', array($this, 'installHandler'));
            $handler->subscribe('billing_install', array($this, 'billingInstallHandler'));
            $handler->subscribe('billing_subscription', array($this, 'billingSubscriptionHandler'));
            $handler->subscribe('uninstall', array($this, 'uninstallHandler'));

        }catch(HandlerException $ex){
            throw new Exception('Handler initialization failed', 0, $ex);
        }
    }

    /**
     * dispatches controller
     * @param array|null $data
     * @throws Exception
     */
    public function dispatch($data = null)
    {
        try {
            $this->handler->dispatch($data);
        } catch (HandlerException $ex) {
            if ($ex->getCode() == HandlerException::HASH_FAILED) {
                throw new Exception('Payload hash verification failed', 0, $ex);
            }
        } catch (Exception $ex) {
            throw $ex;
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
     * @throws Exception
     */
    public function installHandler($arguments)
    {

        try {
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
                throw new Exception('Client error', 0, $ex);
            }

            // store tokens in db
            $tokensStmt = $conn->prepare('INSERT INTO access_tokens (shop_id, expires_at, access_token, refresh_token) VALUES (?,?,?,?)');
            $expirationDate = date('Y-m-d H:i:s', time() + $tokens['expires_in']);
            $tokensStmt->execute(array(
                $shopId, $expirationDate, $tokens['access_token'], $tokens['refresh_token']
            ));

        } catch (PDOException $ex) {
            throw new Exception('Database error', 0, $ex);
        } catch (Exception $ex) {
            throw $ex;
        }

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
     * @throws Exception
     */
    public function billingInstallHandler($arguments)
    {

        try {
            $shopId = $this->getShopId($arguments['shop']);

            // store payment event
            $conn = $this->getDatabaseConnection();
            $stmt = $conn->prepare('INSERT INTO billings (shop_id) VALUES (?)');
            $stmt->execute(array(
                $shopId
            ));
        } catch (PDOException $ex) {
            throw new Exception('Database error', 0, $ex);
        } catch (Exception $ex) {
            throw $ex;
        }

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
     * @throws Exception
     */
    public function uninstallHandler($arguments)
    {
        try {

            $shopId = $this->getShopId($arguments['shop']);

            $conn = $this->getDatabaseConnection();

            // remove shop's references
            $conn->query('DELETE FROM shops WHERE id=' . (int)$shopId);
            $conn->query('DELETE FROM billings WHERE shop_id=' . (int)$shopId);
            $conn->query('DELETE FROM subscriptions WHERE shop_id=' . (int)$shopId);
            $conn->query('DELETE FROM access_tokens WHERE shop_id=' . (int)$shopId);

        } catch (PDOException $ex) {
            throw new Exception('Database error', 0, $ex);
        } catch (Exception $ex) {
            throw $ex;
        }


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
        try {

            $shopId = $this->getShopId($arguments['shop']);

            // make sure we convert timestamp correctly
            $expiresAt = date('Y-m-d H:i:s', strtotime($arguments['subscription_end_time']));

            if (!$expiresAt) {
                throw new Exception('Malformed timestamp');
            }

            // save subscription event
            $conn = $this->getDatabaseConnection();
            $stmt = $conn->prepare('INSERT INTO subscriptions (shop_id, expires_at) VALUES (?,?)');
            $stmt->execute(array(
                $shopId, $expiresAt
            ));

        } catch (PDOException $ex) {
            throw new Exception('Database error', 0, $ex);
        } catch (Exception $ex) {
            throw $ex;
        }

    }

    /**
     * helper function for ID finding
     * @param $shop
     * @throws Exception
     * @return string
     */
    protected function getShopId($shop)
    {

        $conn = $this->getDatabaseConnection();
        $stmt = $conn->prepare('SELECT id FROM shops WHERE shop=?');

        $stmt->execute(array(
            $shop
        ));
        $id = $stmt->fetchColumn(0);
        if (!$id) {
            throw new Exception('Shop not found: ' . $shop);
        }

        return $id;
    }

}

try {
    $controller = new SomeApplicationController();
    $controller->dispatch();

}catch(Exception $ex){
    printf('Something went wrong: %s'.PHP_EOL, $ex->getMessage());
    if($previous = $ex->getPrevious()){
        printf('Previous exception details: %s'.PHP_EOL, $previous->getMessage());
    }
}