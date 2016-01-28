<?php

namespace DreamCommerce;

use Psr\Log\LoggerInterface;

/**
 * Interface ClientInterface
 *
 * @package DreamCommerce
 */
interface ClientInterface
{
    /**
     * Authentication
     *
     * @param boolean $force if set - ignore set accessToken on adapter and force getting a new one
     * @return \stdClass
     * Example output:
     * {
     *      access_token:   'xxxxx',
     *      expires_in:     '3600',
     *      token_type:     'bearer'
     * }
     */
    public function authenticate($force = false);

    /**
     * Performs REST request
     *
     * @param Resource $res a resource to perform request against
     * @param string $method HTTP method name
     * @param null|array|int $objectPath URL path of resource
     * @param array $data payload
     * @param array $query query string values
     * @return array
     * @throws \DreamCommerce\Exception\ClientException
     */
    public function request(Resource $res, $method, $objectPath = null, $data = array(), $query = array());

    /**
     * setter for http client
     *
     * @param HttpInterface $httpClient
     * @return $this
     */
    public function setHttpClient(HttpInterface $httpClient);

    /**
     * getter for http client
     *
     * @return HttpInterface
     */
    public function getHttpClient();

    /**
     * get current locale
     *
     * @return string
     */
    public function getLocale();

    /**
     * set messages locale
     *
     * @param string $locale
     * @return $this
     */
    public function setLocale($locale);

    /**
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * @return LoggerInterface
     */
    public function getLogger();

    /**
     * fired if token is invalid
     * @param Callable|null $callback
     * @return $this
     */
    public function setOnTokenInvalidHandler($callback = null);
}