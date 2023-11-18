<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['correo']) && isset($_GET['contrasena']) && isset($_GET['Iduser'])){
    
        Client::ActualizarUsuario($_GET['correo'], $_GET['contrasena'], $_GET['Iduser']);

    }


?>