<?php

    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['nombre'])){
    
        Client::VisualizarCandidato($_GET['nombre']);

    }
    




?>