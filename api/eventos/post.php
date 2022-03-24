<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');

    include_once '../../config/Database.php';
    include_once '../../models/Eventos.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $db = new Database();
      $db = $db->connect();

      $evento = new Eventos($db);

      $data = json_decode(file_get_contents("php://input"));

      $evento->descripcion = $data->descripcion;
      $evento->id_disciplinas = $data->id_disciplinas;
    
      if($evento->postData()) {
        echo json_encode(array('message' => 'Success'));
      } else {
        echo json_encode(array('message' => 'Error'));
      }
    } else {
        echo json_encode(array('message' => "Error"));
    }