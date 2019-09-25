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

namespace DreamCommerce\Component\ShopAppstore\Api;

use DreamCommerce\Component\ShopAppstore\Info;
use InvalidArgumentException;
use Psr\Http\Message\RequestInterface;
use Webmozart\Assert\Assert;

final class Criteria
{
    const PART_EXPRESSIONS          = 'expressions';
    const PART_ORDERING             = 'ordering';
    const PART_LIMIT                = 'limit';
    const PART_PAGE                 = 'page';

    const OPERATOR_EQUAL            = '=';
    const OPERATOR_NOT_EQUAL        = '!=';
    const OPERATOR_GREATER          = '>';
    const OPERATOR_GREATER_EQUAL    = '>=';
    const OPERATOR_LESS             = '<';
    const OPERATOR_LESS_EQUAL       = '<=';
    const OPERATOR_LIKE             = 'like';
    const OPERATOR_NOT_LIKE         = 'not like';
    const OPERATOR_IN               = 'in';
    const OPERATOR_NOT_IN           = 'not in';

    const ALL_OPERATORS = [
        self::OPERATOR_EQUAL,
        self::OPERATOR_NOT_EQUAL,
        self::OPERATOR_GREATER,
        self::OPERATOR_GREATER_EQUAL,
        self::OPERATOR_LESS,
        self::OPERATOR_LESS_EQUAL,
        self::OPERATOR_LIKE,
        self::OPERATOR_NOT_LIKE,
        self::OPERATOR_IN,
        self::OPERATOR_NOT_IN
    ];

    /**
     * @var array|null
     */
    private $expressions;

    /**
     * @var array|null
     */
    private $orderings;

    /**
     * @var int|null
     */
    private $page;

    /**
     * @var int|null
     */
    private $limit;

    /**
     * Creates an instance of the class.
     *
     * @return Criteria
     */
    public static function create()
    {
        return new static();
    }

    public function __construct()
    {
        $this->reset();
    }

    /**
     * @param string $field
     * @param array|string|null $value
     * @param string $operator
     * @return self
     */
    public function where(string $field, $value = null, $operator = self::OPERATOR_EQUAL): self
    {
        $this->expressions = [];
        $this->andWhere($field, $value, $operator);

        return $this;
    }

    /**
     * @param string $field
     * @param array|string|null $value
     * @param string $operator
     * @return Criteria
     */
    public function andWhere(string $field, $value = null, $operator = self::OPERATOR_EQUAL): self
    {
        if(preg_match('/^([a-z0-9\._]+)[ ]?(>|>=|<=|<|=|!=|like|not like|is null|is not null)(.*)$/i', $field, $matches)) {
            $field = trim($matches[1]);
            $operator = trim($matches[2]);
            $value = trim($matches[3], " \"'");

            if($operator === 'is null') {
                $operator = self::OPERATOR_EQUAL;
                $value = null;
            } elseif($operator === 'is not null') {
                $operator = self::OPERATOR_NOT_EQUAL;
                $value = null;
            }
        }

        Assert::oneOf($operator, self::ALL_OPERATORS);

        if(!isset($this->expressions[$field])) {
            $this->expressions[$field] = [];
        }

        if(is_array($value)) {
            if($operator === self::OPERATOR_EQUAL) {
                $operator = self::OPERATOR_IN;
            } elseif($operator === self::OPERATOR_NOT_EQUAL) {
                $operator = self::OPERATOR_NOT_IN;
            } elseif(!in_array($operator, [ self::OPERATOR_IN, self::OPERATOR_NOT_IN ])) {
                throw new InvalidArgumentException('Unsupported operator "' . $operator . '"');
            }
        } elseif(is_scalar($value) || is_null($value)) {
            if ($operator === self::OPERATOR_IN) {
                $operator = self::OPERATOR_EQUAL;
            } elseif ($operator === self::OPERATOR_NOT_IN) {
                $operator = self::OPERATOR_NOT_EQUAL;
            }
        } else {
            throw new InvalidArgumentException('Expected string or array. Got: ' . (is_object($value) ? get_class($value) : gettype($value)));
        }

        $this->expressions[$field][$operator] = $value;

        return $this;
    }

    /**
     * @param string|array $expr syntax:
     * <field> (asc|desc)
     * or
     * (+|-)<field>
     * @return self
     * @throws \RuntimeException
     */
    public function orderBy($expr): self
    {
        $expr = (array)$expr;

        foreach($expr as $e) {
            // basic syntax, with asc/desc suffix
            if (preg_match('/([a-z0-9\._]+) (asc|desc)$/i', $e)) {
                $this->orderings[] = $e;
            } else if (preg_match('/([\+\-]?)([a-z_0-9.]+)/i', $e, $matches)) {
                // alternative syntax - with +/- prefix
                $subResult = $matches[2];
                if ($matches[1] == '' || $matches[1] == '+') {
                    $subResult .= ' asc';
                } else {
                    $subResult .= ' desc';
                }
                $this->orderings[] = $subResult;
            } else {
                throw new InvalidArgumentException('Unsupported expression "' . $e . '"');
            }
        }

        return $this;
    }

    /**
     * @param int|null $page
     * @return self
     */
    public function setPage(?int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPage(): ?int
    {
        return $this->page;
    }

    public function nextPage(): void
    {
        $this->page++;
    }

    public function prevPage(): void
    {
        if($this->page === 0) {
            // TODO throw
        }

        $this->page--;
    }

    /**
     * @param int|null $limit
     * @return self
     */
    public function setMaxResults(?int $limit): self
    {
        if($limit > Info::MAX_API_ITEMS) {
            // TODO throw
        }

        $this->limit = $limit;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxResults(): ?int
    {
        return $this->limit;
    }

    /**
     * Gets the expression attached to this Criteria.
     *
     * @return array|null
     */
    public function getWhereExpression()
    {
        return $this->expressions;
    }

    /**
     * Gets the current orderings of this Criteria.
     *
     * @return string[]
     */
    public function getOrderings()
    {
        return $this->orderings;
    }

    /**
     * @param string $part
     * @return void
     */
    public function reset(string $part = null): void
    {
        if($part === self::PART_LIMIT || $part === null) {
            $this->limit = Info::MAX_API_ITEMS;
        }
        if($part === self::PART_PAGE || $part === null) {
            $this->page = 1;
        }
        if($part === self::PART_EXPRESSIONS || $part === null) {
            $this->expressions = [];
        }
        if($part === self::PART_ORDERING || $part === null) {
            $this->orderings = [];
        }
    }

    public function rewind(): void
    {
        $this->page = 1;
        $this->limit = Info::MAX_API_ITEMS;
    }

    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function fillRequest(RequestInterface $request): RequestInterface
    {
        $query = [];
        if(count($this->expressions) > 0) {
            $query['filters'] = $this->expressions;
        }
        if(count($this->orderings) > 0) {
            $query['order'] = $this->orderings;
        }
        if($this->limit !== null) {
            $query['limit'] = $this->limit;
        }
        if($this->page !== null) {
            $query['page'] = $this->page;
        }

        if(count($query) > 0) {
            $uri = $request->getUri();
            parse_str($uri->getQuery(), $params);
            $query = array_merge($params, $query);
            ksort($query);

            $uri = $uri->withQuery(http_build_query($query, '', '&'));
            $request = $request->withUri($uri);
        }

        return $request;
    }
}