<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Disciplinas.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $disciplina = new Disciplinas($db);

        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id)) {
            $disciplina->id = $data->id;

            if($disciplina->fetchOne()) {

                print_r(json_encode(array(
                    'id' => $disciplina->id,
                    'descripcion' => $disciplina->descripcion
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