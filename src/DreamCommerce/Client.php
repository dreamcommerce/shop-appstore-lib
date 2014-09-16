<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 16.09.14
 * Time: 10:04
 */

namespace Dreamcommerce;


class Client {

    protected $clientId = null;
    protected $clientSecret = null;

    /**
     * @var Http|null
     */
    protected $client = null;

    public function __construct($clientId, $clientSecret){
        $this->client = new Http();

        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function refreshToken($authCode){
        //
    }

}