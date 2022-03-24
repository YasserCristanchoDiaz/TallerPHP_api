<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Eventos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $evento = new Eventos($db);

        $res = $evento->fetchAll();
        $resCount = $res->rowCount();

        if($resCount > 0) {

            $eventos = array();

            while($row = $res->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                array_push($eventos, array( 'id' => $id, 'descripcion' => $descripcion, 'id_disciplina' => $id_disciplina));
            }
            
            echo json_encode($eventos);

        } else {
            echo json_encode(array('message' => "No hay registros"));
        }
    } else {
        echo json_encode(array('message' => "Error"));
    }