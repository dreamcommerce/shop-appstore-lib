<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Exception;

/**
 * Resource ApplicationVersion
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/application-version
 * @since shop 5.7.0
 */
class ApplicationVersion extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'application-version';

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