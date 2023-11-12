<?php

require_once ('../includes/AuthToken.php');

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"));

// Simula la autenticación (reemplázalo con tu lógica real de autenticación)
if ($data->correo === 'usuario@ejemplo.com' && $data->contrasena === 'contrasena123') {
    // Usuario autenticado, generamos un token
    $userId = 1; // Reemplaza con el ID real del usuario
    $accountType = 'candidato'; // Reemplaza con el tipo de cuenta real
    $token = AuthToken::generateToken($userId, $accountType);

    // Devolvemos el token en la respuesta
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'token' => $token]);
} else {
    // Usuario no autenticado
    header('Content-Type: application/json');
    http_response_code(401); // No autorizado
    echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
}

?>
