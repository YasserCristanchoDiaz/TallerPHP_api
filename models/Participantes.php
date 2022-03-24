<?php

class Participantes {

    private $conn;
    
    public $id;
    public $nombre;
    public $apellido;
    public $edad;
    public $peso;
    public $altura;
    public $id_disciplina;

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
            $this->altura = $row['altura'];
            $this->id_disciplina = $row['id_disciplina'];

            return TRUE;

        }
        
        return FALSE;
    }

    public function postData() {

        $stmt = $this->conn->prepare('INSERT INTO participantes SET nombre = :nombre, apellido = :apellido, edad = :edad, peso = :peso, altura = :altura, id_disciplina = :id_disciplina');

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':edad', $this->edad);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':altura', $this->altura);
        $stmt->bindParam(':id_disciplina', $this->id_disciplina);

        if($stmt->execute()) {
            return TRUE;
        }

        return FALSE;
    }

    public function putData() {

        $stmt = $this->conn->prepare('UPDATE participantes SET nombre = :nombre, apellido = :apellido, edad = :edad, peso = :peso, altura = :altura, id_disciplina = :id_disciplina WHERE id = :id');

        $stmt->bindParam(':nombre', $this->nombre);
        $stmt->bindParam(':apellido', $this->apellido);
        $stmt->bindParam(':edad', $this->edad);
        $stmt->bindParam(':peso', $this->peso);
        $stmt->bindParam(':altura', $this->altura);
        $stmt->bindParam(':id_disciplina', $this->id_disciplina);
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