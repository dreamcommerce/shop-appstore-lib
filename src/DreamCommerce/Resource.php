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

    /**
     * @var string|null resource name
     */
    protected $name = null;

    /**
     * @var null|string chosen filters placeholder
     */
    protected $filters = null;
    /**
     * @var null|int limiter value
     */
    protected $limit = null;
    /**
     * @var null|string ordering value
     */
    protected $order = null;
    /**
     * @var null|int page number
     */
    protected $page = null;

    public function __construct(Client $client, $name){
        $this->client = $client;
        $this->name = $name;
    }

    /**
     * returns resource name
     * @return string
     */
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

        // everything is okay when 200-299 status code
        if($code>=200 && $code<300){
            // for example, last insert ID
            if(is_numeric($response['data'])){
                return $response['data'];
            }

            // check response validity
            if(!is_object($response['data'])){
                throw new ResourceException('', ResourceException::MALFORMED_RESPONSE);
            }

            // the response is a list, process
            if(isset($response['data']->list)){

                $list = $response['data']->list;

                // make data access more elastic, regardless getters - array or properties
                array_walk($list, function(&$v){
                    $v = new \ArrayObject($v, \ArrayObject::ARRAY_AS_PROPS);
                });

                // collection is an array
                $result = new \ArrayObject($list);
                $meta = (array)$response['data'];

                unset($meta['list']);

                // add meta properties (eg. count, page, etc) as a ArrayObject properties
                foreach($meta as $k=>$v){
                    $result->{$k} = $v;
                }
                return $result;
            }else{
                // no list, pass pure response
                return $response['data'];
            }

        }else{

            $msg = '';

            // look up for error
            if(isset($response['data']->error)){
                $msg = $response['data']->error;
            }

            throw new ResourceException($msg, $code);
        }
    }

    /**
     * reset filters object state
     */
    protected function reset(){
        $this->filters = array();
        $this->limit = null;
        $this->order = null;
        $this->page = null;
    }

    /**
     * get an array with specified criteria
     * @return array
     */
    protected function getCriteria(){
        $result = array();

        if($this->filters){
            $result['filters'] = $this->filters;
        }

        if($this->limit!==null){
            $result['limit'] = $this->limit;
        }

        if($this->order!==null){
            $result['order'] = $this->order;
        }

        if($this->page!==null){
            $result['page'] = $this->page;
        }

        // reset object state, we don't need it for further requests
        $this->reset();

        return $result;
    }

    /**
     * set records limit
     * @param int $count collection's items limit in range 1-50
     * @return $this
     * @throws ResourceException
     */
    public function limit($count){
        if($count<1 || $count>50){
            throw new ResourceException('Limit beyond 1-50 range', ResourceException::LIMIT_BEYOND_RANGE);
        }

        $this->limit = $count;

        return $this;
    }

    /**
     * set filters for finding
     * @param array $filters
     * @return $this
     * @throws ResourceException
     */
    public function filters($filters){
        if(!is_array($filters)){
            throw new ResourceException('Filters not specified', ResourceException::FILTERS_NOT_SPECIFIED);
        }

        $this->filters = json_encode($filters);

        return $this;
    }

    /**
     * specify page
     * @param int $page
     * @return $this
     * @throws ResourceException
     */
    public function page($page){

        $page = (int)$page;

        if($page<0){
            throw new ResourceException('Invalid page specified', ResourceException::INVALID_PAGE);
        }

        $this->page = $page;

        return $this;
    }

    /**
     * order record by column
     * @param string $expr syntax:
     * <field> (asc|desc)
     * or
     * (+|-)<field>
     * @return $this
     * @throws ResourceException
     */
    public function order($expr){

        $matches = array();

        // basic syntax, with asc/desc suffix
        if(preg_match('#([a-z_0-9]+) (asc|desc)$#si', $expr)){
            $this->order = $expr;
        }else if(preg_match('#([\+\-]?)([a-z_0-9]+)#', $expr, $matches)){

            // alternative syntax - with +/- prefix
            $result = $matches[2];
            if($matches[1]=='' || $matches[1]=='+'){
                $result .= ' asc';
            }else{
                $result .= ' desc';
            }
            $this->order = $result;
        }else{
            // something which should never happen but take care [;
            throw new ResourceException('Cannot understand ordering expression', ResourceException::ORDER_NOT_SUPPORTED);
        }

        return $this;

    }

    /**
     * Read Resource
     * @param int|null $id
     * @return ArrayObject
     * @throws ResourceException
     */
    public function get($id = null){

        $query = $this->getCriteria();

        try {
            $response = $this->client->request($this, 'get', $id, array(), $query);
        }catch(ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return $this->transformResponse($response);
    }

    /**
     * Create Resource
     * @param array $data
     * @return ArrayObject
     * @throws ResourceException
     */
    public function post($data){

        if($this->getCriteria()){
            throw new ResourceException('Filtering not supported in POST', ResourceException::FILTERS_IN_UNSUPPORTED_METHOD);
        }

        try {
            $response = $this->client->request($this, 'post', null, $data);
        }catch (ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }
        return $this->transformResponse($response);
    }

    /**
     * Update Resource
     * @param int $id
     * @param array $data
     * @return bool
     * @throws ResourceException
     */
    public function put($id, $data){

        if($this->getCriteria()){
            throw new ResourceException('Filtering not supported in PUT', ResourceException::FILTERS_IN_UNSUPPORTED_METHOD);
        }

        try {
            $this->client->request($this, 'put', $id, $data);
        }catch(ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return true;
    }

    /**
     * Delete Resource
     * @param int $id
     * @return bool
     * @throws ResourceException
     */
    public function delete($id){

        if($this->getCriteria()){
            throw new ResourceException('Filtering not supported in DELETE', ResourceException::FILTERS_IN_UNSUPPORTED_METHOD);
        }

        try {
            $this->client->request($this, 'delete', $id);
        }catch(ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return true;
    }

} 