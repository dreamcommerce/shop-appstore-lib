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

namespace DreamCommerce\Component\ShopAppstore\Tests\Billing;

use DreamCommerce\Component\ShopAppstore\Billing\DispatcherInterface;
use DreamCommerce\Component\ShopAppstore\Billing\Resolver\ResolverRegistry;
use DreamCommerce\Component\ShopAppstore\Tests\Fixtures\Billing\ExampleResolver;
use PHPUnit\Framework\TestCase;
use stdClass;
use Sylius\Component\Registry\ServiceRegistryInterface;

class ResolverRegistryTest extends TestCase
{
    /**
     * @var ResolverRegistry
     */
    private $resolver;

    public function setUp(): void
    {
        $this->resolver = new ResolverRegistry();
    }

    public function testShouldImplements(): void
    {
        $this->assertInstanceOf(ServiceRegistryInterface::class, $this->resolver);
    }

    /**
     * @dataProvider validResolvers
     *
     * @param string $action
     * @param string $className
     */
    public function testRegisterValidResolver(string $action, string $className): void
    {
        $resolver = new $className();
        $this->resolver->register($action, $resolver);
        $this->assertSame($resolver, $this->resolver->get($action));
    }

    /**
     * @dataProvider invalidResolvers
     * @expectedException \InvalidArgumentException
     *
     * @param string $action
     * @param string $className
     */
    public function testRegisterInvalidResolver(string $action, string $className): void
    {
        $this->resolver->register($action, new $className());
    }

    /* --------------------------------------------------------------------- */

    public function validResolvers(): array
    {
        return [
            [DispatcherInterface::ACTION_INSTALL, ExampleResolver::class],
        ];
    }

    public function invalidResolvers(): array
    {
        return [
            [DispatcherInterface::ACTION_INSTALL, stdClass::class],
            ['test', ExampleResolver::class],
            ['test', stdClass::class],
        ];
    }
}
