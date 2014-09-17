<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:04
 */

namespace Dreamcommerce;


use Dreamcommerce\Exceptions\ClientException;

/**
 * Dreamcommerce requesting library
 * @package Dreamcommerce
 */
class Client {

    /**
     * API entrypoint
     * @var null|string
     */
    protected $entrypoint = null;

    /**
     * OAuth ID
     * @var null|string
     */
    protected $clientId = null;
    /**
     * OAuth secret
     * @var null|string
     */
    protected $clientSecret = null;

    /**
     * @var Http|null
     */
    protected $client = null;

    /**
     * @param string $entrypoint shop url
     * @param string $clientId
     * @param string $clientSecret
     * @throws Exceptions\ClientException
     */
    public function __construct($entrypoint, $clientId, $clientSecret){
        if(!filter_var($entrypoint, FILTER_VALIDATE_URL)){
            throw new ClientException(ClientException::ENTRYPOINT_URL_INVALID);
        }

        $this->client = new Http();

        // adjust base URL
        if($entrypoint[strlen($entrypoint)-1]=='/'){
            $entrypoint = substr($entrypoint, 0, -1);
        }

        // adjust webapi query
        if(strpos($entrypoint, '/webapi/rest')===false){
            $entrypoint .= '/webapi/rest';
        }

        $this->entrypoint = $entrypoint;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    /**
     * get OAuth tokens
     * @param string $authCode
     * @return array
     * @throws Exceptions\ClientException
     */
    public function getToken($authCode){

        $res = $this->client->post($this->entrypoint.'/oauth', array(
            'client_id'=>$this->clientId,
            'client_secret'=>$this->clientSecret,
            'code'=>$authCode
        ), array(
            'grant_type'=>'authorization_code'
        ));

        if(!$res || $res['data']['error']){
            throw new ClientException($res['error'], ClientException::API_ERROR);
        }

        return $res['data'];
    }

    /**
     * refresh OAuth tokens
     * @param string $refreshToken
     * @return array
     * @throws Exceptions\ClientException
     */
    public function refreshToken($refreshToken){

        $res = $this->client->post($this->entrypoint.'/oauth', array(
            'client_id'=>$this->clientId,
            'client_secret'=>$this->clientSecret,
            'refresh_token'=>$refreshToken
        ), array(
            'grant_type'=>'refresh_token'
        ));

        if(!$res || $res['data']['error']){
            throw new ClientException($res['error'], ClientException::API_ERROR);
        }

        return $res['data'];
    }

}