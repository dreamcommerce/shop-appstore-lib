<?php
namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Exception\ClientException;
use DreamCommerce\Exception\ResourceException;

/**
 * Resource Metafield
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/metafields
 */
class Metafield extends Resource
{
    const TYPE_INT = 1;
    const TYPE_FLOAT = 2;
    const TYPE_STRING = 3;
    const TYPE_BLOB = 4;

    protected $name = 'metafields';

    /**
     * Read Resource
     * @param mixed $args,... params
     * @return \ArrayObject
     * @throws ResourceException
     */
    public function get()
    {
        $query = $this->getCriteria();

        $args = func_get_args();
        if(empty($args)){
            $args = array("system");
        }

        $isCollection = !$this->isSingleOnly && count($args)==1;

        try {
            $response = $this->client->request($this, 'get', $args, array(), $query);
        } catch(ClientException $ex) {
            throw new ResourceException($ex->getMessage(), ResourceException::CLIENT_ERROR, $ex);
        }

        return $this->transformResponse($response, $isCollection);
    }
    
}