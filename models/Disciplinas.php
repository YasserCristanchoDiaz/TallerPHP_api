<?php

class Disciplinas {

    private $conn;
    
    public $id;
    public $descripcion;

    public function __construct($db){
        $this->conn = $db;
    }

    public function fetchAll() {
        
        $stmt = $this->conn->prepare('SELECT * FROM disciplinas');
        $stmt->execute();
        return $stmt;
    }

    public function fetchOne() {

        $stmt = $this->conn->prepare('SELECT  * FROM disciplinas WHERE id = ?');
        $stmt->bindParam(1, $this->id);
        $stmt->execute();        

        if($stmt->rowCount() > 0) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->descripcion = $row['descripcion'];

            return TRUE;

        }
        
        return FALSE;
    }

    public function postData() {

        $stmt = $this->conn->prepare('INSERT INTO disciplinas SET descripcion = :descripcion');

        $stmt->bindParam(':descripcion', $this->descripcion);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {

        $stmt = $this->conn->prepare('UPDATE disciplinas SET descripcion = :descripcion WHERE id = :id');

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete() {

        $stmt = $this->conn->prepare('DELETE FROM disciplinas WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }


}