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

use Iterator;

interface DataInterface extends Iterator
{
    /**
     * @param array $data
     */
    public function setData(array $data): void;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return array
     */
    public function getDiffData(): array;

    /**
     * @param string $field
     * @return mixed
     */
    public function getFieldValue(string $field);

    /**
     * @param string $field
     * @param mixed $value
     */
    public function setFieldValue(string $field, $value): void;
}