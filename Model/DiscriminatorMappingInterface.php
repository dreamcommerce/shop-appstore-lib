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

interface DiscriminatorMappingInterface
{
    /**
     * Get mapping information to class for mapping by discriminator (entity field)
     *
     * Should return array similar to:
     * [
     *      TYPE_VALUE1    => Full\Qualified\NameSpace\To\Mapping\Class1,
     *      TYPE_VALUE2    => Full\Qualified\NameSpace\To\Mapping\Class2,
     *      TYPE_VALUE3    => Full\Qualified\NameSpace\To\Mapping\Class3,
     * ];
     *
     * @return array
     */
    public static function getMapClass(): array;

    /**
     * @return string
     */
    public static function getMapField(): string;
}
