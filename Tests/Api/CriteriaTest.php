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

namespace DreamCommerce\Component\ShopAppstore\Tests\Api;

use DreamCommerce\Component\ShopAppstore\Api\Criteria;
use DreamCommerce\Component\ShopAppstore\Info;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class CriteriaTest extends TestCase
{
    /**
     * @var Criteria
     */
    private $criteria;

    public function setUp()
    {
        $this->criteria = new Criteria();
    }

    public function testCreate(): void
    {
        $this->criteria = Criteria::create();
        self::assertInstanceOf(Criteria::class, $this->criteria);
    }

    public function testWhere(): void
    {
        $this->assertCount(0, $this->criteria->getWhereExpression());

        $this->criteria->where('field_1', 'value_1');

        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => 'value_1']], $expr);
    }

    public function testWhereOperator(): void
    {
        $this->criteria->where('field_1', 'value_1', Criteria::OPERATOR_NOT_EQUAL);

        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_NOT_EQUAL => 'value_1']], $expr);
    }

    public function testWhereSameField(): void
    {
        $this->criteria->where('field_1', 'value_1');
        $this->assertCount(1, $this->criteria->getWhereExpression());

        $this->criteria->where('field_1', 'value_2');

        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => 'value_2']], $expr);
    }

    public function testWhereReset(): void
    {
        $this->criteria->where('field_1', 'value_1');
        $this->assertCount(1, $this->criteria->getWhereExpression());

        $this->criteria->where('field_2', 'value_2');
        $this->assertCount(1, $this->criteria->getWhereExpression());
    }

    public function testWhereArrayWithEqualOperator(): void
    {
        $this->criteria->where('field_1', [5, 10, 15]);

        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_IN => [5, 10, 15]]], $expr);
    }

    public function testWhereArrayWithNotEqualOperator(): void
    {
        $this->criteria->where('field_1', [15, 20, 25], Criteria::OPERATOR_NOT_EQUAL);

        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_NOT_IN => [15, 20, 25]]], $expr);
    }

    public function testWhereScalarWithInOperator(): void
    {
        $this->criteria->where('field_1', 5, Criteria::OPERATOR_IN);

        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => 5]], $expr);
    }

    public function testWhereScalarWithNotInOperator(): void
    {
        $this->criteria->where('field_1', 15, Criteria::OPERATOR_NOT_IN);

        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_NOT_EQUAL => 15]], $expr);
    }

    public function testWhereSimplifiedSyntax(): void
    {
        // simple query

        $this->criteria->where('field_1 = 1.5');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => 1.5]], $expr);

        // without whitespaces

        $this->criteria->where('field_1=2.5');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => 2.5]], $expr);

        // not equal operator

        $this->criteria->where('field_1 != 3.5');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_NOT_EQUAL => 3.5]], $expr);

        // like operator

        $this->criteria->where('field_1 like 4.5');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_LIKE => 4.5]], $expr);

        // not like operator

        $this->criteria->where('field_1 not like 5.5');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_NOT_LIKE => 5.5]], $expr);

        // single quoted value

        $this->criteria->where('field_1 = \'test\'');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => 'test']], $expr);

        // double quoted value

        $this->criteria->where('field_1 = "test2"');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => 'test2']], $expr);

        // null value

        $this->criteria->where('field_1 is null');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_EQUAL => null]], $expr);

        // not null value

        $this->criteria->where('field_1 is not null');
        $expr = $this->criteria->getWhereExpression();
        $this->assertCount(1, $expr);
        $this->assertEquals(['field_1' => [Criteria::OPERATOR_NOT_EQUAL => null]], $expr);
    }

    public function testAndWhere(): void
    {
        $this->criteria->where('field_1', 'value_1');
        $this->criteria->andWhere('field_2', 'value_2');

        $this->assertCount(2, $this->criteria->getWhereExpression());

        $this->criteria->andWhere('field_1', 'value_3');
        $this->assertCount(2, $this->criteria->getWhereExpression());
    }

    public function testOrderByStandardSyntax(): void
    {
        // without suffix

        $this->criteria->orderBy('field_1');

        $orders = $this->criteria->getOrderings();
        $this->assertCount(1, $orders);
        $this->assertEquals(['field_1 asc'], $orders);

        // with suffix

        $this->criteria->orderBy('field_2 desc');

        $orders = $this->criteria->getOrderings();
        $this->assertCount(2, $orders);
        $this->assertEquals(['field_1 asc', 'field_2 desc'], $orders);
    }

    public function testOrderByAlternativeSyntax(): void
    {
        $this->criteria->orderBy('+field_1');

        $orders = $this->criteria->getOrderings();
        $this->assertCount(1, $orders);
        $this->assertEquals(['field_1 asc'], $orders);

        $this->criteria->orderBy('-field_2');

        $orders = $this->criteria->getOrderings();
        $this->assertCount(2, $orders);
        $this->assertEquals(['field_1 asc', 'field_2 desc'], $orders);
    }

    public function testOrderByMultiple(): void
    {
        $this->criteria->orderBy(['field_1 desc', 'field_2']);

        $orders = $this->criteria->getOrderings();
        $this->assertCount(2, $orders);
        $this->assertEquals(['field_1 desc', 'field_2 asc'], $orders);
    }

    public function testPage(): void
    {
        $this->criteria->setPage(150);
        $this->assertEquals(150, $this->criteria->getPage());
    }

    public function testMaxResults(): void
    {
        $this->criteria->setMaxResults(40);
        $this->assertEquals(40, $this->criteria->getMaxResults());
    }

    public function testRewind(): void
    {
        $this->criteria->setMaxResults(15);
        $this->criteria->setPage(200);
        $this->criteria->rewind();

        $this->assertEquals(Info::MAX_API_ITEMS, $this->criteria->getMaxResults());
        $this->assertEquals(1, $this->criteria->getPage());
    }

    public function testResetAll(): void
    {
        $this->criteria->setMaxResults(30);
        $this->criteria->setPage(5);
        $this->criteria->where('field_1 = 5');
        $this->criteria->orderBy('field_2 desc');

        $this->criteria->reset();

        $this->assertEquals(50, $this->criteria->getMaxResults());
        $this->assertEquals(1, $this->criteria->getPage());
        $this->assertEquals([], $this->criteria->getWhereExpression());
        $this->assertEquals([], $this->criteria->getOrderings());
    }

    /**
     * @dataProvider resetParts
     *
     * @param string $part
     */
    public function testResetParts(string $part): void
    {
        $this->criteria->setMaxResults(30);
        $this->criteria->setPage(5);
        $this->criteria->where('field_1 = 5');
        $this->criteria->orderBy('field_2 desc');

        $this->criteria->reset($part);

        $this->assertEquals(($part == Criteria::PART_LIMIT ? Info::MAX_API_ITEMS : 30), $this->criteria->getMaxResults());
        $this->assertEquals(($part == Criteria::PART_PAGE ? 1 : 5), $this->criteria->getPage());
        $this->assertCount(($part == Criteria::PART_EXPRESSIONS ? 0 : 1), $this->criteria->getWhereExpression());
        $this->assertCount(($part == Criteria::PART_ORDERING ? 0 : 1), $this->criteria->getOrderings());
    }

    /**
     * @dataProvider validRequests
     *
     * @param RequestInterface|MockObject $request
     */
    public function testFillRequest($request): void
    {
        $this->criteria->setMaxResults(30);
        $this->criteria->setPage(5);
        $this->criteria->where('field_1 = 5');
        $this->criteria->andWhere('field_2 > 10');
        $this->criteria->orderBy('field_3 desc');

        $this->criteria->fillRequest($request);
    }

    /* --------------------------------------------------------------------- */

    public function resetParts(): array
    {
        return [
            [Criteria::PART_EXPRESSIONS],
            [Criteria::PART_ORDERING],
            [Criteria::PART_LIMIT],
            [Criteria::PART_PAGE],
        ];
    }

    public function validRequests(): array
    {
        $reqs = [];

        // without query string

        $uri = $this->getMockBuilder(UriInterface::class)->getMock();
        $uri->expects($this->once())
            ->method('getQuery')
            ->willReturn('');

        $uri->expects($this->once())
            ->method('withQuery')
            ->will($this->returnCallback(function ($query) use ($uri) {
                parse_str($query, $params);

                $this->assertEquals(
                    [
                        'filters' => [
                            'field_1' => ['=' => '5'],
                            'field_2' => ['>' => '10'],
                        ],
                        'order' => [
                            'field_3 desc',
                        ],
                        'limit' => '30',
                        'page' => '5',
                    ],
                    $params
                );

                return $uri;
            }));

        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getUri')->willReturn($uri);
        $request->expects($this->once())
            ->method('withUri');

        $reqs[] = [$request];

        // with query string

        $uri = $this->getMockBuilder(UriInterface::class)->getMock();
        $uri->expects($this->once())
            ->method('getQuery')
            ->willReturn('a=1&b[]=2&c[abc]=3');

        $uri->expects($this->once())
            ->method('withQuery')
            ->will($this->returnCallback(function ($query) use ($uri) {
                parse_str($query, $params);

                $this->assertEquals(
                    [
                        'filters' => [
                            'field_1' => ['=' => '5'],
                            'field_2' => ['>' => '10'],
                        ],
                        'order' => [
                            'field_3 desc',
                        ],
                        'limit' => '30',
                        'page' => '5',
                        'a' => '1',
                        'b' => [
                            '2',
                        ],
                        'c' => [
                            'abc' => '3',
                        ],
                    ],
                    $params
                );

                return $uri;
            }));

        $request = $this->getMockBuilder(RequestInterface::class)->getMock();
        $request->method('getUri')->willReturn($uri);
        $request->expects($this->once())
            ->method('withUri');

        $reqs[] = [$request];

        return $reqs;
    }
}
