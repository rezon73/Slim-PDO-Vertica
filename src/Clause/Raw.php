<?php

/**
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 */

namespace Rezon73\PDOVertica\Clause;

use Rezon73\PDOVertica\QueryInterface;

class Raw implements QueryInterface
{
    /** @var string $sql */
    protected $sql;

    /**
     * @param string $sql
     */
    public function __construct(string $sql)
    {
        $this->sql = $sql;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->sql;
    }

    /**
     * @return mixed[]
     */
    public function getValues(): array
    {
        return [];
    }
}
