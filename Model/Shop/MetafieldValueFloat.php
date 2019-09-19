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

namespace DreamCommerce\Component\ShopAppstore\Model\Shop;

use Webmozart\Assert\Assert;

class MetafieldValueFloat extends MetafieldValue
{
    /**
     * @var int
     */
    protected $type = MetafieldInterface::TYPE_FLOAT;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return float
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param float $value
     */
    public function setValue($value): void
    {
        Assert::numeric($value);

        $this->value = (float) $value;
    }
}
