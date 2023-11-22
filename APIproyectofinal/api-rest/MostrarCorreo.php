<?php
// api que recibe el id del candidato almacenado en el localstorage y lo manda a la funcion obtener correo por id para mostrarse en el formulario de actualizar datos
    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['Iduser'])){
    
        Client::ObtenerCorreoPorId($_GET['Iduser']);

    }
    




?>