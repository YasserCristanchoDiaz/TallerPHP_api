<?php

class Eventos {

    private $conn;
    
    public $id;
    public $descripcion;
    public $position;
    public $id_disciplinas;

    public function __construct($db){
        $this->conn = $db;
    }

    public function fetchAll() {
        
        $stmt = $this->conn->prepare('SELECT * FROM eventos');
        $stmt->execute();
        return $stmt;
    }

    public function fetchOne() {

        $stmt = $this->conn->prepare('SELECT  * FROM eventos WHERE id = ?');
        $stmt->bindParam(1, $this->id);
        $stmt->execute();        

        if($stmt->rowCount() > 0) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->descripcion = $row['descripcion'];
            $this->position = $row['position'];
            $this->id_disciplinas = $row['id_disciplinas'];

            return TRUE;

        }
        
        return FALSE;
    }

    public function postData() {

        $stmt = $this->conn->prepare('INSERT INTO eventos SET descripcion = :descripcion, position = :position, id_disciplinas = :id_disciplinas');

        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':id_disciplinas', $this->id_disciplinas);
        

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {

        $stmt = $this->conn->prepare('UPDATE eventos SET descripcion = :descripcion, position = :position, id_disciplinas = :id_disciplinas WHERE id = :id');

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':descripcion', $this->descripcion);
        $stmt->bindParam(':position', $this->position);
        $stmt->bindParam(':id_disciplinas', $this->id_disciplinas);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete() {

        $stmt = $this->conn->prepare('DELETE FROM eventos WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }


}