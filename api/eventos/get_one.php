<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Eventos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $evento = new Eventos($db);

        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id)) {
            $evento->id = $data->id;

            if($evento->fetchOne()) {

                print_r(json_encode(array(
                    'id' => $evento->id,
                    'descripcion' => $evento->descripcion,
                    'position' => $evento->position,
                    'id_disciplinas' => $evento->id_disciplinas
                )));

            } else {
                echo json_encode(array('message' => "No hay registros"));
            }

        } else {
            echo json_encode(array('message' => "Error"));
        }
    } else {
        echo json_encode(array('message' => "Error"));
    }