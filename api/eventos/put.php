<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../config/Database.php';
    include_once '../../models/Eventos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {

		$db = new Database();
		$db = $db->connect();

		$evento = new Eventos($db);

		$data = json_decode(file_get_contents("php://input"));

		$evento->id = isset($data->id) ? $data->id : NULL;
		$evento->descripcion = $data->descripcion;
		$evento->id_disciplina = $data->id_disciplina;

		if(! is_null($evento->id)) {

			if($evento->putData()) {
			echo json_encode(array('message' => 'Success'));
			} else {
			echo json_encode(array('message' => 'Error'));
			}
		} else {
		echo json_encode(array('message' => "Error"));
		}
	} else {
		echo json_encode(array('message' => "Error"));
	}