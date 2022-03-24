<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Participantes.php';

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        $db = new Database();
        $db = $db->connect();

        $participante = new Participantes($db);

        $res = $participante->fetchAll();
        $resCount = $res->rowCount();

        if($resCount > 0) {

            $participantes = array();

            while($row = $res->fetch(PDO::FETCH_ASSOC)) {

                extract($row);
                array_push($participantes, array( 'id' => $id, 'nombre' => $nombre, 'apellido' => $apellido, 'edad' => $edad, 'peso' => $peso, 'estatura' => $estatura, 'id_disciplinas' => $id_disciplinas));
            }
            
            echo json_encode($participantes);

        } else {
            echo json_encode(array('message' => "No hay registros"));
        }
    } else {
        echo json_encode(array('message' => "Error"));
    }