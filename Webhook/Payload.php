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

namespace DreamCommerce\Component\ShopAppstore\Webhook;

use DreamCommerce\Component\ShopAppstore\Model\ItemInterface;

final class Payload
{
    /**
     * @var ItemInterface
     */
    private $item;

    /**
     * @var int
     */
    private $webhookId;

    /**
     * @var string
     */
    private $webhookName;

    /**
     * @param ItemInterface $item
     * @param int $webhookId
     * @param string $webhookName
     */
    public function __construct(ItemInterface $item, int $webhookId, string $webhookName)
    {
        $this->item = $item;
        $this->webhookId = $webhookId;
        $this->webhookName = $webhookName;
    }


    /**
     * @return ItemInterface
     */
    public function getItem(): ItemInterface
    {
        return $this->item;
    }

    /**
     * @return int
     */
    public function getWebhookId(): int
    {
        return $this->webhookId;
    }

    /**
     * @return string
     */
    public function getWebhookName(): string
    {
        return $this->webhookName;
    }
}