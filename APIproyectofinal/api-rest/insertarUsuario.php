<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['correo']) && isset($_GET['contrasena'])){
    
        Client::insertarUsuario($_GET['correo'], $_GET['contrasena']);

    }
    




?>