<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['Iduser'])){
    
        Client::EliminarCorreo($_GET['Iduser']);

    }


?>