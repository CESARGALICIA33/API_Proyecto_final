<?php
//Api que recibe el id del cliente y lo manda a la funcion de obtener candidato por id, utilizado en el formulario de editar.html
    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Iduser'])){
    
        Client::ObtenerCandidatoPorId($_GET['Iduser']);

    }

?>