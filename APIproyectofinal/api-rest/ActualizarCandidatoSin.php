<?php
// api que recibe los datos del candidato para despues mandarlos a la funcion de actualizar candidatos(update)
require_once('../includes/Client.class.php');

// Verificar que la solicitud sea del tipo PUT
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Obtener datos del cuerpo de la solicitud (payload)
    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);

    // Verificar la existencia de los campos requeridos
    $requiredFields = array(
        'Iduser', 'nombre', 'apellido_materno', 'apellido_paterno', 'genero',
        'telefono', 'calle', 'colonia', 'num_int', 'num_ext',
        'codigoPostal', 'experiencia', 'educacion', 'habilidades',
        'fecha_nacimiento', 'disponibilidad', 'salario'
    );

    $missingFields = array();
    foreach ($requiredFields as $field) {
        if (!isset($data[$field])) {
            $missingFields[] = $field;
        }
    }

    if (empty($missingFields)) {
        // Obtener los valores del cuerpo de la solicitud
        $nombre = $data['nombre'];
        $apellido_materno = $data['apellido_materno'];
        $apellido_paterno = $data['apellido_paterno'];
        $genero = $data['genero'];
        $telefono = $data['telefono'];
        $calle = $data['calle'];
        $colonia = $data['colonia'];
        $num_int = $data['num_int'];
        $num_ext = $data['num_ext'];
        $codigoPostal = $data['codigoPostal'];
        $experiencia = $data['experiencia'];
        $educacion = $data['educacion'];
        $habilidades = $data['habilidades'];
        $fecha_nacimiento = $data['fecha_nacimiento'];
        $disponibilidad = $data['disponibilidad'];
        $salario = $data['salario'];
        $Iduser = $data['Iduser'];

        // Llamar a la función de actualización del cliente
        Client::ActualizarCandidatoSin(
            $nombre, $apellido_materno, $apellido_paterno, $genero, $telefono, $calle, $colonia, $num_int,
            $num_ext, $codigoPostal, $experiencia, $educacion, $habilidades, $fecha_nacimiento,
            $disponibilidad, $salario, $Iduser
        );

        // Enviar una respuesta exitosa
        echo json_encode(array('success' => 'Actualización exitosa'));
    } else {
        // Enviar un mensaje de error indicando campos faltantes
        http_response_code(400); // Bad Request
        echo json_encode(array('error' => 'Datos incorrectos o incompletos en la solicitud.', 'missingFields' => $missingFields));
    }
} else {
    // Enviar un mensaje de error si el método no es PUT
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('error' => 'Método no permitido. Se espera una solicitud PUT.'));
}
?>
