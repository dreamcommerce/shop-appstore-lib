<?php

namespace DreamCommerce;

use Psr\Log\LoggerInterface;

interface ClientInterface
{
    /**
     * Get OAuth tokens
     *
     * @param string $authCode
     * @return \stdClass
     * @throws Exception\ClientException
     */
    public function getToken($authCode);

    /**
     * Refresh OAuth tokens
     *
     * @param string $refreshToken
     * @return array
     * @throws Exception\ClientException
     */
    public function refreshToken($refreshToken);

    /**
     * Performs REST request
     *
     * @param $res
     * @param string $method
     * @param null|array|int $objectPath
     * @param array $data
     * @param array $query
     * @return array
     * @throws ClientException
     */
    public function request(Resource $res, $method, $objectPath = null, $data = array(), $query = array());

    /**
     * @param HttpInterface $httpClient
     * @return $this
     */
    public function setHttpClient(HttpInterface $httpClient);

    /**
     * @return HttpInterface
     */
    public function getHttpClient();

    /**
     * @param LoggerInterface $logger
     * @return $this
     */
    public function setLogger(LoggerInterface $logger);

    /**
     * @return LoggerInterface
     */
    public function getLogger();
}