<?php

/*
 * This file is part of the DreamCommerce Shop AppStore package.
 *
 * (c) DreamCommerce
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace DreamCommerce\Component\ShopAppstore\Model;

class Application implements ApplicationInterface
{
    /**
     * @var string
     */
    private $appId;

    /**
     * @var string
     */
    private $appSecret;

    /**
     * @var string
     */
    private $appstoreSecret;

    /**
     * @param string $appId
     * @param string $appSecret
     * @param string $appstoreSecret
     */
    public function __construct($appId, $appSecret, $appstoreSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->appstoreSecret = $appstoreSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * {@inheritdoc}
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function getAppstoreSecret(): string
    {
        return $this->appstoreSecret;
    }
}
