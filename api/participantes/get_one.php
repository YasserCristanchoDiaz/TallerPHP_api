<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Participantes.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $participante = new Participantes($db);

        $data = json_decode(file_get_contents("php://input"));

        if(isset($data->id)) {
            $participante->id = $data->id;

            if($participante->fetchOne()) {

                print_r(json_encode(array(
                    'id' => $participante->id,
                    'nombre' => $participante->nombre,
                    'apellido' => $participante->apellido,
                    'edad' => $participante->edad,
                    'peso' => $participante->peso,
                    'altura' => $participante->altura,
                    'id_disciplina' => $participante->id_disciplina
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