<?php

    require_once('../includes/Client.class.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' &&
        isset($_POST['nombre'], $_POST['apellido_materno'], $_POST['apellido_paterno'], $_POST['genero'],
            $_POST['telefono'], $_POST['calle'], $_POST['colonia'], $_POST['num_int'],
            $_POST['num_ext'], $_POST['codigoPostal'], $_POST['experiencia'], $_POST['educacion'],
            $_POST['habilidades'], $_POST['fecha_nacimiento'], $_FILES['curriculum'], $_FILES['constancia'],
            $_POST['disponibilidad'], $_POST['salario'], $_POST['idusuario'])) {

        // Obtener los valores de $_POST y $_FILES
        $nombre = $_POST['nombre'];
        $apellido_materno = $_POST['apellido_materno'];
        $apellido_paterno = $_POST['apellido_paterno'];
        $genero = $_POST['genero'];
        $telefono = $_POST['telefono'];
        $calle = $_POST['calle'];
        $colonia = $_POST['colonia'];
        $num_int = $_POST['num_int'];
        $num_ext = $_POST['num_ext'];
        $codigoPostal = $_POST['codigoPostal'];
        $experiencia = $_POST['experiencia'];
        $educacion = $_POST['educacion'];
        $habilidades = $_POST['habilidades'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $disponibilidad = $_POST['disponibilidad'];
        $salario = $_POST['salario'];
        $idusuario = $_POST['idusuario'];

        // Obtener el contenido de los archivos
        $curriculumContent = file_get_contents($_FILES['curriculum']['tmp_name']);
        $constanciaContent = file_get_contents($_FILES['constancia']['tmp_name']);

        Client::InsertarCandidato(
            $nombre, $apellido_materno, $apellido_paterno, $genero, $telefono, $calle, $colonia, $num_int,
            $num_ext, $codigoPostal, $experiencia, $educacion, $habilidades, $fecha_nacimiento,
            $curriculumContent, $constanciaContent, $disponibilidad, $salario, $idusuario
        );
    }


?>
