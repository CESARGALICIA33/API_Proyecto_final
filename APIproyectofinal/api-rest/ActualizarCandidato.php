<?php

    require_once('../includes/Client.class.php');

    if ($_SERVER['REQUEST_METHOD'] == 'PUT' &&
        isset($_GET['nombre'], $_GET['apellido_materno'], $_GET['apellido_paterno'], $_GET['genero'],
            $_GET['telefono'], $_GET['calle'], $_GET['colonia'], $_GET['num_int'],
            $_GET['num_ext'], $_GET['codigoPostal'], $_GET['experiencia'], $_GET['educacion'],
            $_GET['habilidades'], $_GET['fecha_nacimiento'], $_FILES['curriculum'], $_FILES['constancia'],
            $_GET['disponibilidad'], $_GET['salario'], $_GET['Iduser'])) {

        // Obtener los valores de $_POST y $_FILES
        $nombre = $_GET['nombre'];
        $apellido_materno = $_GET['apellido_materno'];
        $apellido_paterno = $_GET['apellido_paterno'];
        $genero = $_GET['genero'];
        $telefono = $_GET['telefono'];
        $calle = $_GET['calle'];
        $colonia = $_GET['colonia'];
        $num_int = $_GET['num_int'];
        $num_ext = $_GET['num_ext'];
        $codigoPostal = $_GET['codigoPostal'];
        $experiencia = $_GET['experiencia'];
        $educacion = $_GET['educacion'];
        $habilidades = $_GET['habilidades'];
        $fecha_nacimiento = $_GET['fecha_nacimiento'];
        $disponibilidad = $_GET['disponibilidad'];
        $salario = $_GET['salario'];
        $Iduser = $_GET['Iduser'];

        // Obtener el contenido de los archivos
        $curriculumContent = file_get_contents($_FILES['curriculum']['tmp_name']);
        $constanciaContent = file_get_contents($_FILES['constancia']['tmp_name']);

        Client::InsertarCandidato(
            $nombre, $apellido_materno, $apellido_paterno, $genero, $telefono, $calle, $colonia, $num_int,
            $num_ext, $codigoPostal, $experiencia, $educacion, $habilidades, $fecha_nacimiento,
            $curriculumContent, $constanciaContent, $disponibilidad, $salario, $Iduser
        );
    }


?>
