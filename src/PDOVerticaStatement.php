<?php

namespace Rezon73\PDO;

class PDOVerticaStatement
{
    protected $qry;
    protected $param;
    protected $stmt;

    public function __construct($conn, $qry)
    {
        $this->qry = preg_replace('/(?<=\s|^):[^\s:]++/um', '?', $qry);
        $this->param = null;

        $this->extractParam($qry);

        $this->stmt = odbc_prepare($conn, $this->qry);
    }

    public function bindValue($param, $val)
    {
        if (!is_null($val)) {
            $this->param[$param] = $val;
        }
    }

    public function execute($params = [])
    {
        if (!empty($params)) {
            foreach ($params as $param => $val) {
                $this->bindValue($param, $val);
            }
        }

        if($this->param == null) {
            $result = odbc_execute($this->stmt);
        } else {
            $result = odbc_execute($this->stmt, $this->param);
        }

        $this->clearParam();

        return $result;
    }

    public function fetch($option = null)
    {
        return odbc_fetch_array($this->stmt);
    }

    public function fetchAll($option = null)
    {
        $rows = [];
        while($row = odbc_fetch_array($this->stmt)){
            $rows[] = $row;
        }

        return $rows;
    }

    public function rowCount()
    {
        return odbc_num_rows($this->stmt);
    }

    public function errorInfo(): string
    {
        return odbc_errormsg($this->stmt);
    }

    protected function extractParam($qry)
    {
        $qryArray = explode(" ", $qry);
        $ind = 0;

        while (isset($qryArray[$ind])) {
            if (preg_match("/^:/", $qryArray[$ind])) {
                $this->param[$qryArray[$ind]] = null;
            }

            ++$ind;
        }
    }

    protected function clearParam()
    {
        $ind = 0;

        while(isset($this->param[$ind])) {
            $this->param[$ind] = null;
            ++$ind;
        }
    }
}