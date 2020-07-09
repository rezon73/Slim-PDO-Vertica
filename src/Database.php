<?php

/**
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 */

namespace Rezon73\PDOVertica;

use PDO;

class Database extends PDOVertica
{
    /**
     * @param string            $dsn
     * @param string|null       $username
     * @param string|null       $password
     * @param array<int, mixed> $options
     *
     * @codeCoverageIgnore
     */
    public function __construct(string $dsn, string $username = null, string $password = null, array $options = [])
    {
        parent::__construct($dsn, $username, $password, array_merge($this->getDefaultOptions(), $options));
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<int, mixed>
     */
    protected function getDefaultOptions(): array
    {
        return [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }

    /**
     * @param Clause\Method|null $procedure
     *
     * @return Rezon73\PDOVertica\Statement\Call
     */
    public function call(Clause\Method $procedure = null): Rezon73\PDOVertica\Statement\Call
    {
        return new Rezon73\PDOVertica\Statement\Call($this, $procedure);
    }

    /**
     * @param array<int|string, string> $columns
     *
     * @return Rezon73\PDOVertica\Statement\Select
     */
    public function select(array $columns = ['*']): Rezon73\PDOVertica\Statement\Select
    {
        return new Rezon73\PDOVertica\Statement\Select($this, $columns);
    }

    /**
     * @param array<int|string, mixed> $pairs
     *
     * @return Rezon73\PDOVertica\Statement\Insert
     */
    public function insert(array $pairs = []): Rezon73\PDOVertica\Statement\Insert
    {
        return new Rezon73\PDOVertica\Statement\Insert($this, $pairs);
    }

    /**
     * @param array<string, mixed> $pairs
     *
     * @return Rezon73\PDOVertica\Statement\Update
     */
    public function update(array $pairs = []): Rezon73\PDOVertica\Statement\Update
    {
        return new Rezon73\PDOVertica\Statement\Update($this, $pairs);
    }

    /**
     * @param string|array<string, string> $table
     *
     * @return Rezon73\PDOVertica\Statement\Delete
     */
    public function delete($table = null): Rezon73\PDOVertica\Statement\Delete
    {
        return new Rezon73\PDOVertica\Statement\Delete($this, $table);
    }
}
