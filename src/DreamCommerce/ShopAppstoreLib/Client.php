<?php

namespace DreamCommerce\ShopAppstoreLib;

use DreamCommerce\ShopAppstoreLib\Exception\ClientException;

/**
 * DreamCommerce requesting library
 *
 * @package DreamCommerce
  */
class Client
{
    const ADAPTER_OAUTH = 'OAuth';
    const ADAPTER_BASIC_AUTH = 'BasicAuth';

    /**
     * @var Client\OAuth
     */
    protected $adapter = null;

    /**
     * @var ClientInterface
     */
    protected static $defaultAdapter = null;

    /**
     * @param string $adapter
     * @param array $options
     * @return ClientInterface
     * @throws ClientException
     */
    public static function factory($adapter, $options = array())
    {
        if (!is_string($adapter) || empty($adapter)) {
            throw new ClientException('Adapter name must be specified in a string');
        }

        if (!is_array($options)) {
            throw new ClientException('Adapter parameters must be in an array');
        }

        $adapterNamespace = '\\DreamCommerce\ShopAppstoreLib\\Client';
        if (isset($config['adapterNamespace'])) {
            if ($config['adapterNamespace'] != '') {
                $adapterNamespace = $config['adapterNamespace'];
            }
            unset($config['adapterNamespace']);
        }

        $adapterName = $adapterNamespace . '\\';
        $adapterName .= str_replace(' ', '\\', ucwords(str_replace('\\', ' ', $adapter)));

        if (!class_exists($adapterName)) {
            throw new ClientException('Cannot load class "' . $adapterName . '"');
        }

        $clientAdapter = new $adapterName($options);

        if(!($clientAdapter instanceof ClientInterface)) {
            throw new ClientException('Adapter class "' . $adapterName . '" does not implement \\DreamCommerce\ShopAppstoreLib\\ClientInterface');
        }

        if(self::$defaultAdapter === null) {
            self::$defaultAdapter = $clientAdapter;
        }

        return $clientAdapter;
    }

    /**
     * @return null|ClientInterface
     */
    public static function getDefaultAdapter()
    {
        return self::$defaultAdapter;
    }

    /**
     * @param ClientInterface $adapter
     */
    public static function setDefaultAdapter(ClientInterface $adapter)
    {
        self::$defaultAdapter = $adapter;
    }

}