<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../config/Database.php';
    include_once '../../models/Disciplinas.php';

	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {

		$db = new Database();
		$db = $db->connect();

		$disciplina = new Disciplinas($db);

		$data = json_decode(file_get_contents("php://input"));

		$disciplina->id = isset($data->id) ? $data->id : NULL;

		if(! is_null($disciplina->id)) {
	
			if($disciplina->delete()) {
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