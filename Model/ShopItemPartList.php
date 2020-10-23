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

final class ShopItemPartList extends AbstractShopItemList implements ShopItemPartListInterface
{
    use ShopDependTrait;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $page;

    /**
     * @var int
     */
    private $totalPages;

    /**
     * @param array $items
     * @param int $total
     * @param int $page
     * @param int $totalPages
     */
    public function __construct(array $items = [], int $total = 0, int $page = 1, int $totalPages = 0)
    {
        $this->total = $total;
        $this->page = $page;
        $this->totalPages = $totalPages;

        parent::__construct($items);
    }

    /**
     * {@inheritdoc}
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * {@inheritdoc}
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * {@inheritdoc}
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total)
    {
        $this->total = $total;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->page = $page;
    }

    /**
     * @param int $totalPages
     */
    public function setTotalPages(int $totalPages)
    {
        $this->totalPages = $totalPages;
    }
}
