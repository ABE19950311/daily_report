<?php

class MysqlModel {
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=192.168.64.5;dbname=daily_report;charset=utf8";
        $user = "daily";
        $password = "daily";
        $option = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        try {
            $this->pdo = new PDO($dsn,$user,$password,$option);
        } catch(PDOException $error) {
            echo $error;
        }
    }
    
    public function dbSelect($table,$colmun,$query,$params=[]) {
        try {
            $sqlQuery = "SELECT $colmun FROM $table WHERE $query";
            $stmt = $this->pdo->prepare($sqlQuery);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch(PDOException $error) {
            echo $error;
        }
    }
    
    public function dbInsert($table,$colmun,$query,$params=[]) {
        try {
            $sqlQuery = "INSERT INTO $table $colmun VALUES ($query)";
            $this->pdo->prepare($sqlQuery);
            $stmt->execute($params);
            return $this->pdo->lastInsertId();
        } catch (PODException $error) {
            echo $error;
        }
    }

}


?>