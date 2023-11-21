<?php


require_once('../includes/Client.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener el contenido del cuerpo de la solicitud
    $inputData = json_decode(file_get_contents("php://input"), true);

    if (
        $inputData &&
        isset(
            $inputData['Iduser'], $inputData['nombre'], $inputData['apellido_materno'], $inputData['apellido_paterno'], $inputData['genero'],
            $inputData['telefono'], $inputData['calle'], $inputData['colonia'], $inputData['num_int'],
            $inputData['num_ext'], $inputData['codigoPostal'], $inputData['experiencia'], $inputData['educacion'],
            $inputData['habilidades'], $inputData['fecha_nacimiento'], $inputData['disponibilidad'], $inputData['salario']
        )
    ) {
        // Obtener los valores del formulario
        $Iduser = $inputData['Iduser'];
        $nombre = $inputData['nombre'];
        $apellido_materno = $inputData['apellido_materno'];
        $apellido_paterno = $inputData['apellido_paterno'];
        $genero = $inputData['genero'];
        $telefono = $inputData['telefono'];
        $calle = $inputData['calle'];
        $colonia = $inputData['colonia'];
        $num_int = $inputData['num_int'];
        $num_ext = $inputData['num_ext'];
        $codigoPostal = $inputData['codigoPostal'];
        $experiencia = $inputData['experiencia'];
        $educacion = $inputData['educacion'];
        $habilidades = $inputData['habilidades'];
        $fecha_nacimiento = $inputData['fecha_nacimiento'];
        $disponibilidad = $inputData['disponibilidad'];
        $salario = $inputData['salario'];

        // Verificar si los archivos están presentes
        if (isset($_FILES['curriculum'], $_FILES['constancia'])) {
            // Obtener el contenido de los archivos
            $curriculumContent = file_get_contents($_FILES['curriculum']['tmp_name']);
            $constanciaContent = file_get_contents($_FILES['constancia']['tmp_name']);

            // Llamar a la función para actualizar el candidato
            Client::ActualizarCandidato(
                $nombre, $apellido_materno, $apellido_paterno, $genero, $telefono, $calle, $colonia, $num_int,
                $num_ext, $codigoPostal, $experiencia, $educacion, $habilidades, $fecha_nacimiento,
                $curriculumContent, $constanciaContent, $disponibilidad, $salario, $Iduser
            );
        } else {
            http_response_code(400); // Bad Request
            $missingFields = array();
        
            // Verificar qué campos específicos faltan
            if (empty($_POST['nombre'])) {
                $missingFields[] = 'nombre';
            }
            if (empty($_POST['apellido_materno'])) {
                $missingFields[] = 'apellido_materno';
            }
            if (empty($_POST['apellido_paterno'])) {
                $missingFields[] = 'apellido_paterno';
            }
            if (empty($_POST['genero'])) {
                $missingFields[] = 'genero';
            }
            if (empty($_POST['telefono'])) {
                $missingFields[] = 'telefono';
            }
            if (empty($_POST['calle'])) {
                $missingFields[] = 'calle';
            }
            if (empty($_POST['colonia'])) {
                $missingFields[] = 'colonia';
            }
            if (empty($_POST['num_int'])) {
                $missingFields[] = 'num_int';
            }
            if (empty($_POST['num_ext'])) {
                $missingFields[] = 'num_ext';
            }
            if (empty($_POST['codigoPostal'])) {
                $missingFields[] = 'codigoPostal';
            }
            if (empty($_POST['experiencia'])) {
                $missingFields[] = 'experiencia';
            }
            if (empty($_POST['educacion'])) {
                $missingFields[] = 'educacion';
            }
            if (empty($_POST['habilidades'])) {
                $missingFields[] = 'habilidades';
            }
            if (empty($_POST['fecha_nacimiento'])) {
                $missingFields[] = 'fecha_nacimiento';
            }
            if (empty($_FILES['curriculum'])) {
                $missingFields[] = 'curriculum';
            }
            if (empty($_FILES['constancia'])) {
                $missingFields[] = 'constancia';
            }
            if (empty($_POST['disponibilidad'])) {
                $missingFields[] = 'disponibilidad';
            }
            if (empty($_POST['salario'])) {
                $missingFields[] = 'salario';
            }
        
            echo json_encode(array('error' => 'Falta uno o ambos archivos.', 'missingFields' => $missingFields));
        }
    } else {
        http_response_code(404); // Bad Request
        echo json_encode(array('error' => 'Datos incorrectos o incompletos en la solicitud.'));
    }
}






/*if ($_SERVER['REQUEST_METHOD'] == 'PUT' &&
isset($_GET['Iduser'], $_GET['nombre'], $_GET['apellido_materno'], $_GET['apellido_paterno'], $_GET['genero'],
    $_GET['telefono'], $_GET['calle'], $_GET['colonia'], $_GET['num_int'],
    $_GET['num_ext'], $_GET['codigoPostal'], $_GET['experiencia'], $_GET['educacion'],
    $_GET['habilidades'], $_GET['fecha_nacimiento'], $_FILES['curriculum'], $_FILES['constancia'],
    $_GET['disponibilidad'], $_GET['salario'])) {

// Obtener los valores de $_GET y $_FILES
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

Client::ActualizarCandidato(
    $nombre, $apellido_materno, $apellido_paterno, $genero, $telefono, $calle, $colonia, $num_int,
    $num_ext, $codigoPostal, $experiencia, $educacion, $habilidades, $fecha_nacimiento,
    $curriculumContent, $constanciaContent, $disponibilidad, $salario, $Iduser
);
}*/
?>
