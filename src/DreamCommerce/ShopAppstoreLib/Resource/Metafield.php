<?php
namespace DreamCommerce\ShopAppstoreLib\Resource;

use DreamCommerce\ShopAppstoreLib\Resource;
use DreamCommerce\ShopAppstoreLib\Exception\ClientException;

/**
 * Resource Metafield
 *
 * @package DreamCommerce\ShopAppstoreLib\Resource
 * @link https://developers.shoper.pl/developers/api/resources/metafields
 */
class Metafield extends Resource
{
    /**
     * type of integer
     */
    const TYPE_INT = 1;
    /**
     * type of float
     */
    const TYPE_FLOAT = 2;
    /**
     * type of string
     */
    const TYPE_STRING = 3;
    /**
     * type of binary data
     */
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
            throw new Resource\Exception\CommunicationException($ex->getMessage(), $ex);
        }

        return $this->transformResponse($response, $isCollection);
    }
    
}