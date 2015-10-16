<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Exception;

/**
 * Resource ApplicationLock
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/application-lock
 */
class ApplicationLock extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'application-lock';

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