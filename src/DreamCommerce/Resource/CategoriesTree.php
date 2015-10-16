<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Exception;

/**
 * Resource CategoriesTree
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/categories-tree
 */
class CategoriesTree extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'categories-tree';

    /**
     * {@inheritdoc}
     */
    public function head($data)
    {
        throw new Exception('Specified method is not supported');
    }

    /**
     * {@inheritdoc}
     */
    public function post($data)
    {
        throw new Exception('Specified method is not supported');
    }

    /**
     * {@inheritdoc}
     */
    public function put($id = null, $data = array())
    {
        throw new Exception('Specified method is not supported');
    }

    /**
     * {@inheritdoc}
     */
    public function delete($id = null)
    {
        throw new Exception('Specified method is not supported');
    }
}