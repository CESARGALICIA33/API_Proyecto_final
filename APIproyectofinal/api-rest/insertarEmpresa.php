<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['nombre']) && isset($_GET['contrasena'])){
    
        Client::insertarEmpresa($_GET['nombre'], $_GET['contrasena']);

    }
    




?>