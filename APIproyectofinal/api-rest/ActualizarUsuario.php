<?php
// api que recibe datos como el correo y contraeña  nuevos, para realizar le update a la tabla Usuarios por medio del id que le proporcione el cliente
    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['correo']) && isset($_GET['contrasena']) && isset($_GET['Iduser'])){
    
        Client::ActualizarUsuario($_GET['correo'], $_GET['contrasena'], $_GET['Iduser']);

    }


?>