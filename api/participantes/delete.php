<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: *');
    header('Access-Control-Allow-Methods: DELETE');

    include_once '../../config/Database.php';
    include_once '../../models/Participantes.php';

	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

		$db = new Database();
		$db = $db->connect();

		$participante = new Participantes($db);

		$data = json_decode(file_get_contents("php://input"));

		$participante->id = isset($data->id) ? $data->id : NULL;

		if(! is_null($participante->id)) {
	
			if($participante->delete()) {
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