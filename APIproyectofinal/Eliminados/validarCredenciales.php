<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['correo']) && isset($_GET['contrasena']) && isset($_GET['accountType'])){
    
        Client::validarCredenciales($_GET['correo'], $_GET['contrasena'], $_GET['accountType']);

    }
    




?>