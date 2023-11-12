<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['nombre']) && isset($_GET['descripcion'])){
    
        Client::insertarAreaPost($_GET['correo'], $_GET['descripcion']);

    }
    




?>