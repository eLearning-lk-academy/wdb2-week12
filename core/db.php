<?php

class db
{
    private $db;

    public function __construct($mysql)
    {
        $this->connect($mysql);
    }

    private function connect($mysql)
    {

        try {
            $dsn = 'mysql:host=' . $mysql['host'] . ';dbname=' . $mysql['database'] . ';port=' . $mysql['port'];

            $this->db = new PDO($dsn, $mysql['username'], $mysql['password']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function query($query, $params = array()){
        $statement = $this->db->prepare($query);

        if($statement){
            $result = $statement->execute($params);
            if($result){
                return $statement;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getRow( $query, $params = array()){
        $query = $this->query($query, $params);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function getAll( $query, $params = array()){
        $query = $this->query($query, $params);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertRow( $query, $params = array()){
        $query = $this->query($query, $params);
        return $this->db->lastInsertId();
    }

    public function updateRow( $query, $params = array()){
        $query = $this->query($query, $params);
        return $query;
    }

    public function deleteRow($table, $id){
        $sql = 'DELETE FROM '.$table.' WHERE id = ?';
        $statement = $this->query($sql, [ $id ]);
        return $statement;
    }

}
