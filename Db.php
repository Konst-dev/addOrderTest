<?php
class Db
{
    private
        $config = [
            'driver' => 'mysql',
            'host' => 'localhost',
            'login' => 'root',
            'password' => '',
            'database' => 'nevatrip',
            'charset' => 'utf8'
        ];

    private $connection = null;

    private function getConnection()
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDsnString(), $this->config['login'], $this->config['password']);
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;
    }

    private function prepareDsnString()
    {
        return sprintf(
            "%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    private function query($sql, $params)
    {
        $STH = $this->getConnection()->prepare($sql);
        $STH->execute($params);
        return $STH;
    }

    public function queryWhereAssoc($sql, $params)
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(\PDO::FETCH_ASSOC);
        return $STH->fetchAll();
    }

    public function barcodeExistsInDb($barcode)
    {
        $sql = "SELECT barcode FROM orders WHERE barcode=:barcode LIMIT 1";
        $result = $this->queryWhereAssoc($sql, ['barcode' => $barcode]);
        if (count($result)) return true;

        return false;
    }

    public function insertOrder($props)
    {
        foreach ($props as $key => $value) {
            $params[':' . $key] = $value;
            $columns[] = $key;
        }
        $columns = implode(',', $columns);
        $values = implode(',', array_keys($params));
        $sql = "INSERT INTO orders ({$columns}) VALUES ({$values})";
        if ($this->query($sql, $params))
            return true;
        return false;
    }
}
