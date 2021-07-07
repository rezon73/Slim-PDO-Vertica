<?php

namespace Rezon73\PDOVertica;

class PDOVertica
{
    protected $conn;

    public function __construct($dsn, $user, $password, $options)
    {
        $this->conn = odbc_connect($dsn, $user, $password);
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function prepare($qry)
    {
        return new PDOVerticaStatement($this->conn, $qry);
    }

    public function exec($qry, $flags = null)
    {
        return odbc_exec($this->conn, $qry, $flags);
    }

    public function lastInsertId()
    {
        $stmt = odbc_prepare($this->conn, 'SELECT LAST_INSERT_ID()');
        odbc_execute($stmt);
        $res = odbc_fetch_array($stmt);
        
        return $res['LAST_INSERT_ID'] ?? null;
    }
}