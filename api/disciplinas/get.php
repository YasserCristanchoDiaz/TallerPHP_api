<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Disciplinas.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $disciplina = new Disciplinas($db);

        $res = $disciplina->fetchAll();
        $resCount = $res->rowCount();

        if($resCount > 0) {

            $disciplinas = array();

            while($row = $res->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                array_push($disciplinas, array( 'id' => $id, 'descripcion' => $descripcion));
            }
            
            echo json_encode($disciplinas);

        } else {
            echo json_encode(array('message' => "No hay registros"));
        }
    } else {
        echo json_encode(array('message' => "Error"));
    }