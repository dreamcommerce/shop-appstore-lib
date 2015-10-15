<?php

namespace DreamCommerce;

use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\ResourceException;

/**
 * Class Resource
 * @package DreamCommerce
 */
abstract class Resource
{
    /**
     * @var ClientInterface|null
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

    /**
     * @var bool specifies whether resource has no collection at all
     */
    protected $isSingleOnly = false;

    /**
     * @var array
     */
    protected static $resources = array();

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param ClientInterface $client
     * @param string $name
     * @param boolean $forceRecreateResource
     * @return Resource
     * @throws ResourceException
     */
    public static function factory(ClientInterface $client, $name, $forceRecreateResource = false)
    {
        $name = ucfirst($name);
        if(!isset(self::$resources[$name]) || $forceRecreateResource) {

            $class = "\\DreamCommerce\\Resource\\" . $name;
            if (class_exists($class)) {
                self::$resources[$name] = new $class($client);
            } else {
                throw new ResourceException("Unknown Resource '" . $name . "'");
            }
        }

        return self::$resources[$name];
    }

    /**
     * returns resource name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $response
     * @param bool $isCollection should transform response as a collection?
     * @throws ResourceException
     * @return mixed
     */
    protected function transformResponse($response, $isCollection)
    {
        $code = null;
        if(isset($response['headers']['Code'])) {
            $code = $response['headers']['Code'];
        }

        // everything is okay when 200-299 status code
        if($code >= 200 && $code < 300){
            // for example, last insert ID
            if($isCollection){
                if(isset($response['data']['list'])) {
                    $objectList = new ResourceList($response['data']['list']);
                } else {
                    $objectList = new ResourceList();
                }

                // add meta properties (eg. count, page, etc) as a ArrayObject properties
                if(isset($response['data']['page'])) {
                    $objectList->setPage($response['data']['page']);
                } elseif(isset($response['headers']['X-Shop-Result-Page'])) {
                    $objectList->setPage($response['headers']['X-Shop-Result-Page']);
                }

                if(isset($response['data']['count'])) {
                    $objectList->setCount($response['data']['count']);
                } elseif(isset($response['headers']['X-Shop-Result-Count'])) {
                    $objectList->setCount($response['headers']['X-Shop-Result-Count']);
                }

                if(isset($response['data']['pages'])) {
                    $objectList->setPageCount($response['data']['pages']);
                } elseif(isset($response['headers']['X-Shop-Result-Pages'])) {
                    $objectList->setPageCount($response['headers']['X-Shop-Result-Pages']);
                }

                return $objectList;
            }else{

                $result = $response['data'];

                if(!is_scalar($response['data'])) {
                    $result = new \ArrayObject(
                        ResourceList::transform($result)
                    );
                }

                return $result;
            }

        }else{

            $msg = '';

            // look up for error
            if(isset($response['data']['error'])){
                $msg = $response['data']['error'];
            }

            throw new ResourceException($msg, $code);
        }
    }

    /**
     * reset filters object state
     */
    public function reset()
    {
        $this->filters = array();
        $this->limit = null;
        $this->order = null;
        $this->page = null;

        return $this;
    }

    /**
     * get an array with specified criteria
     * @return array
     */
    protected function getCriteria()
    {
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

        return $result;
    }

    /**
     * set records limit
     * @param int $count collection's items limit in range 1-50
     * @return $this
     * @throws ResourceException
     */
    public function limit($count)
    {
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
    public function filters($filters)
    {
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
    public function page($page)
    {
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
    public function order($expr)
    {
        $matches = array();

        // basic syntax, with asc/desc suffix
        if(preg_match('/([a-z_0-9.]+) (asc|desc)$/i', $expr)) {
            $this->order = $expr;
        } else if(preg_match('/([\+\-]?)([a-z_0-9.]+)/i', $expr, $matches)) {

            // alternative syntax - with +/- prefix
            $result = $matches[2];
            if($matches[1]=='' || $matches[1]=='+'){
                $result .= ' asc';
            } else {
                $result .= ' desc';
            }
            $this->order = $result;
        } else {
            // something which should never happen but take care [;
            throw new ResourceException('Cannot understand ordering expression', ResourceException::ORDER_NOT_SUPPORTED);
        }

        return $this;

    }

    /**
     * Read Resource
     *
     * @param mixed $args,... params
     * @return \ArrayObject
     * @throws ResourceException
     */
    public function get()
    {
        $query = $this->getCriteria();

        $args = func_get_args();
        if(empty($args)){
            $args = null;
        }

        $isCollection = $this->isCollection($args);

        try {
            $response = $this->client->request($this, 'get', $args, array(), $query);
        } catch(ClientException $ex) {
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return $this->transformResponse($response, $isCollection);
    }

    /**
     * Read Resource without data
     *
     * @return \ArrayObject
     * @throws ResourceException
     */
    public function head()
    {
        $query = $this->getCriteria();

        $args = func_get_args();
        if(empty($args)){
            $args = null;
        }

        try {
            $response = $this->client->request($this, 'head', $args, array(), $query);
        } catch(ClientException $ex) {
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return $this->transformResponse($response, true);
    }

    /**
     * determines if resource call is collection or not
     * @param $args
     * @return bool
     */
    protected function isCollection($args)
    {
        return !$this->isSingleOnly && count($args)==0;
    }

    /**
     * Create Resource
     * @param array $data
     * @return integer
     * @throws ResourceException
     */
    public function post($data)
    {
        if($this->getCriteria()){
            $this->reset();
        }

        $args = func_get_args();
        if(count($args) == 1) {
            $args = null;
        } else {
            $data = array_pop($args);
        }

        try {
            $response = $this->client->request($this, 'post', $args, $data);
        } catch (ClientException $ex) {
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return $response['data'];
    }

    /**
     * Update Resource
     * @param null|int $id
     * @param array $data
     * @return bool
     * @throws ResourceException
     */
    public function put($id = null, $data = array())
    {
        if($this->getCriteria()){
            $this->reset();
        }

        $args = func_get_args();
        if(count($args) == 2){
            $args = $id;
        }else{
            $data = array_pop($args);
        }

        try {
            $this->client->request($this, 'put', $args, $data);
        } catch(ClientException $ex) {
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
    public function delete($id = null)
    {
        if($this->getCriteria()){
            throw new ResourceException('Filtering not supported in DELETE', ResourceException::FILTERS_IN_UNSUPPORTED_METHOD);
        }

        $args = func_get_args();
        if(count($args) == 1){
            $args = $id;
        }

        try {
            $this->client->request($this, 'delete', $args);
        }catch(ClientException $ex){
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return true;
    }

}
