<?php
/**
 * Created by PhpStorm.
 * User: eRIZ
 * Date: 2014-09-22
 * Time: 09:21
 */

namespace Dreamcommerce;

use Dreamcommerce\Exceptions\ClientException;
use Dreamcommerce\Exceptions\ResourceException;

class Resource{

    /**
     * @var Client|null
     */
    public $client = null;

    protected $name = null;

    public function __construct(Client $client, $name){
        $this->client = $client;
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    /**
     * @param $response
     * @return int|ArrayObject
     * @throws ResourceException
     */
    protected function transformResponse($response){
        $code = $response['headers']['Code'];

        if($code>=200 && $code<=200){
            if(is_numeric($response['data'])){
                return $response['data'];
            }

            if(!is_array($response['data'])){
                throw new ResourceException('', ResourceException::MALFORMED_RESPONSE);
            }

            if(isset($response['data']['list'])){

                $list = $response['data']['list'];
                $result = new \ArrayObject($list);
                $meta = $response['data'];
                unset($meta['list']);
                foreach($meta as $k=>$v){
                    $result->{$k} = $v;
                }
                return $result;
            }else{
                return $response['data'];
            }

        }else{

            $msg = '';

            if($response['data']['error']){
                $msg = $response['data']['error'];
            }

            throw new ResourceException($msg, $code);
        }
    }

    public function get($idOrCriteria = null){
        $object = null;
        $query = array();

        if(is_array($idOrCriteria)){
            $query = $idOrCriteria;
        }else if(is_numeric($idOrCriteria)){
            $object = (int)$idOrCriteria;
        }

        try {
            $response = $this->client->request($this, 'get', $object, array(), $query);
        }catch(ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return $this->transformResponse($response);
    }

    public function post($data){
        try {
            $response = $this->client->request($this, 'post', null, $data, array('XDEBUG_SESSION_START'=>'PHPSTORM'));
        }catch (ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }
        return $this->transformResponse($response);
    }

    public function put($id, $data){
        try {
            $this->client->request($this, 'put', $id, $data);
        }catch(ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return true;
    }

    public function delete($id){
        try {
            $this->client->request($this, 'delete', $id);
        }catch(ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return true;
    }

} 