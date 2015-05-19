<?php

namespace DreamCommerce;

use Psr\Log\LoggerInterface;

interface HttpInterface
{
    /**
     * Performs a GET request
     *
     * @param string $url
     * @param array $query query string params
     * @param array $headers
     * @throws Exception\HttpException
     * @return string
     */
    public function get($url, $query = array(), $headers = array());

    /**
     * Performs a POST request
     *
     * @param string $url
     * @param array|\stdClass $body form fields
     * @param array $query query string params
     * @param array $headers
     * @throws Exception\HttpException
     * @return string
     */
    public function post($url, $body = array(), $query = array(), $headers = array());

    /**
     * Performs a PUT request
     *
     * @param string $url
     * @param array|\stdClass $body form fields
     * @param array $query query string params
     * @param array $headers
     * @throws Exception\HttpException
     * @return string
     */
    public function put($url, $body = array(), $query = array(), $headers = array());

    /**
     * Performs a DELETE request
     *
     * @param $url
     * @param array $query query string params
     * @param array $headers
     * @throws Exception\HttpException
     * @return string
     */
    public function delete($url, $query = array(), $headers = array());

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