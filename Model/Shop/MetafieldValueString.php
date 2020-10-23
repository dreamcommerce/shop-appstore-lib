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

class MetafieldValueString extends MetafieldValue
{
    /**
     * @var int
     */
    protected $type = MetafieldInterface::TYPE_STRING;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value): void
    {
        Assert::string($value);

        $this->value = (string) $value;
    }
}
