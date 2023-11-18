<?php

require_once ('../includes/AuthToken.php');
require_once ('../includes/Database.class.php');

// Obtener datos del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"));

// Verificar si se proporcionaron datos
if (isset($data->correo) && isset($data->contrasena) && isset($data->accountType)) {
    // Obtener los datos del usuario desde la base de datos
    $correo = $data->correo;
    $contrasena = $data->contrasena;
    $accountType = $data->accountType;

    $user = getUserFromDatabase($correo, $contrasena, $accountType);

    // Verificar las credenciales
    if ($user) {
        // Usuario autenticado, generamos un token
        $userId = $user['ID']; // Reemplaza con el campo real del ID del usuario
        $token = AuthToken::generateToken($userId, $accountType);

        // Devolvemos el token en la respuesta
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'token' => $token, 'userId' => $userId]);
    } else {
        // Usuario no autenticado
        header('Content-Type: application/json');
        http_response_code(401); // No autorizado
        echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
    }
} else {
    // Datos incompletos en la solicitud
    header('Content-Type: application/json');
    http_response_code(400); // Solicitud incorrecta
    echo json_encode(['success' => false, 'message' => 'Datos incompletos en la solicitud']);
}

// Función para obtener usuario desde la base de datos
function getUserFromDatabase($correo, $contrasena, $accountType) {
    $conexion = new Conexion();

    try {
        $query = ($accountType == 2)
            ? "SELECT * FROM empresa WHERE Nombre = :correo AND Contraseña = :contrasena"
            : "SELECT * FROM usuario WHERE Correo = :correo AND Contraseña = :contrasena";

        $statement = $conexion->prepare($query);
        $statement->bindParam(':correo', $correo);
        $statement->bindParam(':contrasena', $contrasena);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
        exit;
    }
}

?>
