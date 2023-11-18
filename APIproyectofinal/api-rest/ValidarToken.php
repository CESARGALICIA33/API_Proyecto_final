<?php

require_once ('../includes/AuthToken.php');

$data = json_decode(file_get_contents("php://input"));

// Verificar si se proporcionó el token
if (isset($data->token)) {
    $token = $data->token;

    // Validar el token usando la función del TokenValidator
    $tokenData = AuthToken::validateToken($token);

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

// Resto de tu código
// ...
?>
