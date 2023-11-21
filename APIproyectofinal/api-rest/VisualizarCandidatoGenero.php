<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['genero'])){
    
        Client::VisualizarCandidatoGenero($_GET['genero']);

    }
    




?>