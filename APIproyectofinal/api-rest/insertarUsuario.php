<?php
//api numero 2 apartado de registro.html
    require_once ('../includes/Client.class.php');// referencia al archivo donde se encuentran las clases

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['correo']) && isset($_GET['contrasena'])){//validacion del metodo recibido por el cliemte y extraccion con el metodo isset de los datos
    
        Client::insertarUsuario($_GET['correo'], $_GET['contrasena']);//mandar los datos a la clase CLient que es donde se encuentran los metodos

    }
    




?>