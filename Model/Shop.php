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

use DateTime;
use DreamCommerce\Component\Common\Factory\DateTimeFactoryInterface;
use DreamCommerce\Component\Common\Model\ArrayableInterface;
use DreamCommerce\Component\Common\Model\ArrayableTrait;
use Psr\Http\Message\UriInterface;
use Sylius\Component\Resource\Model\TimestampableTrait;
use Webmozart\Assert\Assert;

class Shop implements ShopInterface, ArrayableInterface
{
    use TimestampableTrait;
    use ArrayableTrait;

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var UriInterface
     */
    private $uri;

    /**
     * @var TokenInterface
     */
    private $token;

    /**
     * @param array $params
     * @param DateTimeFactoryInterface|null $dateTimeFactory
     */
    public function __construct(array $params = array(), DateTimeFactoryInterface $dateTimeFactory = null)
    {
        $this->fromArray($params);

        if ($dateTimeFactory === null) {
            $this->createdAt = new DateTime();
        } else {
            $this->createdAt = $dateTimeFactory->createNew();
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return (string) $this->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function setUri($uri): void
    {
        if(is_string($uri) && class_exists('\\GuzzleHttp\\Psr7\\Uri')) {
            $uri = new \GuzzleHttp\Psr7\Uri($uri);
        } else {
            Assert::isInstanceOf($uri, UriInterface::class);
        }

        $this->uri = $uri;
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): ?UriInterface
    {
        return $this->uri;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken(): ?TokenInterface
    {
        return $this->token;
    }

    /**
     * {@inheritdoc}
     */
    public function setToken(?TokenInterface $token): void
    {
        $this->token = $token;
    }

    /**
     * {@inheritdoc}
     */
    public function isAuthenticated(): bool
    {
        return ($this->token !== null && $this->token->getAccessToken() !== null);
    }
}
