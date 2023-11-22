<?php
//Api que recibe por medio de del cuerpo de la solicitud el id de localstorage y manda a la funcion de eliminar usuario y correo
require_once ('../includes/Client.class.php');

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($data->Iduser)) {
    // Llamar al método para eliminar el candidato
    Client::EliminarUsuarioYCorreos($data->Iduser);
}

?>
