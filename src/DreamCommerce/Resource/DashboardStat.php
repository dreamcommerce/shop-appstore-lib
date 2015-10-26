<?php

namespace DreamCommerce\Resource;

use DreamCommerce\Resource;
use DreamCommerce\Exception;

/**
 * Resource DashboardStat
 *
 * @package DreamCommerce\Resource
 * @link https://developers.shoper.pl/developers/api/resources/dashboard-stats
 */
class DashboardStat extends Resource
{
    protected $isSingleOnly = true;
    protected $name = 'dashboard-stats';

    /**
     * {@inheritdoc}
     */
    public function head()
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