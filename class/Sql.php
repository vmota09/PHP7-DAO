<?php

class Sql extends PDO {

    private $conn;

    public function __construct() {

        $this->conn = new PDO("mysql:host=localhost;dbname=mota", "root", "Desenv#6");

    }

    private function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {

            $this->setParam($statement, $key, $value);

        }

    }

    private function setParam($statement, $key, $value){

        $statement->bindParam($key, $value);

    }

    public function runquery($rawQuery, $params = array()) {

        $stmt = $this->conn->prepare($rawQuery);

        $this->setParams($stmt, $params);

        $stmt->execute();

        return $stmt;

    }

    public function select($rawQuery, $params = array()):array
    {

        $stmt = $this->runquery($rawQuery, $params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}

?>