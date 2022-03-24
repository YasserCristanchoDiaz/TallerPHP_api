<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods: PUT');

    include_once '../../config/Database.php';
    include_once '../../models/Participantes.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

		$db = new Database();
		$db = $db->connect();

		$participante = new Participantes($db);

		$data = json_decode(file_get_contents("php://input"));

		$participante->id = isset($data->id) ? $data->id : NULL;
		$participante->nombre = $data->nombre;
		$participante->apellido = $data->apellido;
		$participante->edad = $data->edad;
		$participante->peso = $data->peso;
		$participante->estatura = $data->estatura;
		$participante->id_disciplinas = $data->id_disciplinas;

		if(! is_null($participante->id)) {

			if($participante->putData()) {
			echo json_encode(array('message' => 'Success'));
			} else {
			echo json_encode(array('message' => 'No hay registros'));
			}
		} else {
		echo json_encode(array('message' => "Error"));
		}
	} else {
		echo json_encode(array('message' => "Error"));
	}