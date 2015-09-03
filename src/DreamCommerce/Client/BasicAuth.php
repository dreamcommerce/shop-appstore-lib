<?php

namespace DreamCommerce\Client;

use DreamCommerce\Resource;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\HttpException;

/**
 * DreamCommerce requesting library
 *
 * @package DreamCommerce\Client
 */
class BasicAuth extends Bearer
{
    /**
     * User login
     * @var null|string
     */
    protected $user = null;
    /**
     * User password
     * @var null|string
     */
    protected $password = null;

    /**
     * @param array $options
     * @throws \DreamCommerce\Exception\ClientException
     *
     * Example:
     * {
     *      entrypoint:     'http://shop.com',
     *      username:       '12345',
     *      password:       '54321'
     * }
     */
    public function __construct($options = array())
    {
        if(!is_array($options)) {
            throw new ClientException('Adapter parameters must be in an array', ClientException::PARAMETER_NOT_SPECIFIED);
        }

        foreach(array('username', 'password') as $reqParam) {
            if(!isset($options[$reqParam])) {
                throw new ClientException('Parameter "' . $reqParam . '" is required', ClientException::PARAMETER_NOT_SPECIFIED);
            }
        }

        $this->username = $options['username'];
        $this->password = $options['password'];

        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate($force = false)
    {
        if($this->accessToken !== null && !$force) {
            return false;
        }

        $res = $this->getHttpClient()->post($this->entrypoint.'/auth', array(), array(
            'client_id' => $this->username,
            'client_secret' => $this->password
        ));

        if(!$res || isset($res['data']['error'])){
            throw new ClientException($res['data']['error'], ClientException::API_ERROR);
        }

        // automatically set token to the freshly requested
        $this->setAccessToken($res['data']['access_token']);

        return $res['data'];
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param null|string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}