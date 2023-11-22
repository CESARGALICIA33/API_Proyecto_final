<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Ruta al archivo autoload.php generado por Composer

use Firebase\JWT\JWT;

class AuthToken
{
    private static $secretKey = 'tu_clave_secreta'; // Clave de seguridad del token

    public static function generateToken($userId, $accountType)
    {
        $tokenId    = base64_encode(random_bytes(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt;  // El token es válido inmediatamente
        $expire     = $issuedAt + 3600;  // Expira en 1 hora

        $data = [
            'iat'  => $issuedAt,         // Tiempo en que se emitió el token
            'jti'  => $tokenId,          // Identificador único para el token
            'nbf'  => $notBefore,        // Token no válido antes de esto
            'exp'  => $expire,           // Tiempo de expiración del token
            'data' => [
                'userId'   => $userId,   //se porporcionan datos del id y tipo de cuenta dentro del cuerpo del token
                'accountType' => $accountType,
            ],
        ];

        return JWT::encode($data, self::$secretKey, 'HS256');
    }

    public static function validateToken($token)// funcion que valida el token si se encuentra valido 
    {
        try {
            $decoded = JWT::decode($token, self::$secretKey, (object)['algorithm' => 'HS256']);
    
            // Verificar si el token ha expirado
            if (isset($decoded->exp) && $decoded->exp < time()) {
                return json_encode(['success' => false, 'message' => 'Token expirado']);
            }
    
    
            return json_encode(['success' => true, 'data' => $decoded->data]);// retorna el token devuelta
    
        } catch (Exception $e) {
            // Otros errores
            error_log('Error al decodificar el token: ' . $e->getMessage());
            return json_encode(['success' => false, 'message' => 'Error al decodificar el token']);
        }
    }
    
    

}
?>
