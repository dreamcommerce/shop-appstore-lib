<?php
namespace BillingSystem;

use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\HandlerException;
use DreamCommerce\Handler;

class App
{

    /**
     * @var null|Handler
     */
    protected $handler = null;

    /**
     * @var array configuration placeholder
     */
    protected $config = array();


    /**
     * @param string $entrypoint
     * @throws \Exception
     */
    public function __construct($entrypoint, $config)
    {

        $this->config = $config;

        try {
            // instantiate a handler
            $handler = $this->handler = new Handler(
                $entrypoint, $config['appId'], $config['appSecret'], $config['appstoreSecret']
            );

            // subscribe to particular events
            $handler->subscribe('install', array($this, 'installHandler'));
            $handler->subscribe('billing_install', array($this, 'billingInstallHandler'));
            $handler->subscribe('billing_subscription', array($this, 'billingSubscriptionHandler'));
            $handler->subscribe('uninstall', array($this, 'uninstallHandler'));

        } catch (HandlerException $ex) {
            throw new \Exception('Handler initialization failed', 0, $ex);
        }
    }

    /**
     * dispatches controller
     * @param array|null $data
     * @throws \Exception
     */
    public function dispatch($data = null)
    {
        try {
            $this->handler->dispatch($data);
        } catch (HandlerException $ex) {
            if ($ex->getCode() == HandlerException::HASH_FAILED) {
                throw new \Exception('Payload hash verification failed', 0, $ex);
            }
        } catch (\Exception $ex) {
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
     * @throws \Exception
     */
    public function installHandler($arguments)
    {

        try {

            // shop installation
            $shopStmt = $this->db()->prepare('INSERT INTO shops (shop, shop_url) values (?,?)');
            $shopStmt->execute(array(
                $arguments['shop'], $arguments['shop_url']
            ));

            $shopId = $this->db()->lastInsertId();

            // get OAuth tokens
            try {
                $tokens = $arguments['client']->getToken($arguments['auth_code']);
            } catch (ClientException $ex) {
                throw new \Exception('Client error', 0, $ex);
            }

            // store tokens in db
            $tokensStmt = $this->db()->prepare('INSERT INTO access_tokens (shop_id, expires_at, access_token, refresh_token) VALUES (?,?,?,?)');
            $expirationDate = date('Y-m-d H:i:s', time() + $tokens->expires_in);
            $tokensStmt->execute(array(
                $shopId, $expirationDate, $tokens->access_token, $tokens->refresh_token
            ));

        } catch (\PDOException $ex) {
            throw new \Exception('Database error', 0, $ex);
        } catch (\Exception $ex) {
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
     * @throws \Exception
     */
    public function billingInstallHandler($arguments)
    {

        try {
            $shopId = $this->getShopId($arguments['shop']);

            // store payment event
            $stmt = $this->db()->prepare('INSERT INTO billings (shop_id) VALUES (?)');
            $stmt->execute(array(
                $shopId
            ));
        } catch (\PDOException $ex) {
            throw new \Exception('Database error', 0, $ex);
        } catch (\Exception $ex) {
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
     * @throws \Exception
     */
    public function uninstallHandler($arguments)
    {
        try {

            $shopId = $this->getShopId($arguments['shop']);

            $conn = $this->db();

            // remove shop's references
            $conn->query('DELETE FROM shops WHERE id=' . (int)$shopId);
            $conn->query('DELETE FROM billings WHERE shop_id=' . (int)$shopId);
            $conn->query('DELETE FROM subscriptions WHERE shop_id=' . (int)$shopId);
            $conn->query('DELETE FROM access_tokens WHERE shop_id=' . (int)$shopId);

        } catch (\PDOException $ex) {
            throw new \Exception('Database error', 0, $ex);
        } catch (\Exception $ex) {
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
     * @throws \Exception
     */
    public function billingSubscriptionHandler($arguments)
    {
        try {

            $shopId = $this->getShopId($arguments->shop);

            // make sure we convert timestamp correctly
            $expiresAt = date('Y-m-d H:i:s', strtotime($arguments->subscription_end_time));

            if (!$expiresAt) {
                throw new \Exception('Malformed timestamp');
            }

            // save subscription event
            $stmt = $this->db()->prepare('INSERT INTO subscriptions (shop_id, expires_at) VALUES (?,?)');
            $stmt->execute(array(
                $shopId, $expiresAt
            ));

        } catch (\PDOException $ex) {
            throw new \Exception('Database error', 0, $ex);
        } catch (\Exception $ex) {
            throw $ex;
        }

    }

    /**
     * helper function for ID finding
     * @param $shop
     * @throws \Exception
     * @return string
     */
    public function getShopId($shop)
    {

        $conn = $this->db();
        $stmt = $conn->prepare('SELECT id FROM shops WHERE shop=?');

        $stmt->execute(array(
            $shop
        ));
        $id = $stmt->fetchColumn(0);
        if (!$id) {
            throw new \Exception('Shop not found: ' . $shop);
        }

        return $id;
    }

    /**
     * return (and instantiate if needed) a db connection
     * @return PDO
     */
    public function db()
    {
        static $handle = null;
        if (!$handle) {
            $handle = new \PDO(
                $this->config['db']['connection'],
                $this->config['db']['user'],
                $this->config['db']['pass']
            );
        }

        return $handle;
    }

}