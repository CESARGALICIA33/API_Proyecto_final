<?php

require_once ('../includes/AuthToken.php');

// Verificar si se proporcionó el token
$token = null;

// Intentar obtener el token desde el cuerpo de la solicitud (JSON)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));
    if (isset($data->token)) {
        $token = $data->token;
    }
}

// Si no se obtuvo el token desde el cuerpo, intentar obtenerlo desde la URL
if (!$token && isset($_GET['token'])) {
    $token = $_GET['token'];
}

if ($token) {
    $secretKey = 'tu_clave_secreta'; // Reemplaza con tu clave secreta

    // Validar el token usando la función del TokenValidator
    $tokenData = AuthToken::validateToken($token, $secretKey, (object)['algorithm' => 'HS256']);

    if ($tokenData) {
        // Token válido
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'token' => $token, 'message' => 'Token válido']);
    } else {
        // Token no válido
        header('Content-Type: application/json');
        http_response_code(401); // No autorizado
        echo json_encode(['success' => false, 'message' => 'Token no válido']);
    }
} else {
    // Token no proporcionado
    header('Content-Type: application/json');
    http_response_code(400); // Solicitud incorrecta
    echo json_encode(['success' => false, 'message' => 'Token no proporcionado']);
}

?>
