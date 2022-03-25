<?php

class Participantes {

    private $conn;
    
    public $id;
    public $nombre;
    public $apellido;
    public $edad;
    public $peso;
    public $estatura;
    public $id_disciplinas;

    public function __construct($db){
        $this->conn = $db;
    }

    public function fetchAll() {
        
        $stmt = $this->conn->prepare('SELECT * FROM participantes');
        $stmt->execute();
        return $stmt;
    }

    public function fetchOne() {

        $stmt = $this->conn->prepare('SELECT  * FROM participantes WHERE id = ?');
        $stmt->bindParam(1, $this->id);
        $stmt->execute();        

        if($stmt->rowCount() > 0) {
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->nombre = $row['nombre'];
            $this->apellido = $row['apellido'];
            $this->edad = $row['edad'];
            $this->peso = $row['peso'];
            $this->estatura = $row['estatura'];
            $this->id_disciplinas = $row['id_disciplinas'];

            return TRUE;

        }
        
        return FALSE;
    }

    public function postData() {

        $stmt = $this->conn->prepare('INSERT INTO participantes SET id = :id, nombre = :nombre, apellido = :apellido, edad = :edad, peso = :peso, estatura = :estatura, id_disciplinas = :id_disciplinas');

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':edad', $this->edad);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':estatura', $this->estatura);
        $stmt->bindParam(':id_disciplinas', $this->id_disciplinas);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {

        $stmt = $this->conn->prepare('UPDATE participantes SET nombre = :nombre, apellido = :apellido, edad = :edad, peso = :peso, estatura = :estatura, id_disciplinas = :id_disciplinas WHERE id = :id');

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':edad', $this->edad);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':estatura', $this->estatura);
        $stmt->bindParam(':id_disciplinas', $this->id_disciplinas);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function delete() {

        $stmt = $this->conn->prepare('DELETE FROM participantes WHERE id = :id');
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }


}