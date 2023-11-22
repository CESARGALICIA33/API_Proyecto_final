<?php
//api que recibe los datos que se almacenaran en comentarios y los manda a la funcion de insertar comentarios
    require_once ('../includes/Client.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['experiencia']) && isset($_GET['motivos'])){
    
        Client::InsertarComentarios($_GET['experiencia'], $_GET['motivos']);

    }
    




?>