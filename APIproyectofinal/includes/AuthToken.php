<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Ruta al archivo autoload.php generado por Composer

use Firebase\JWT\JWT;

class AuthToken
{
    private static $secretKey = 'tu_clave_secreta'; // Cambia esto a una clave segura y secreta

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
                'userId'   => $userId,   // Puedes incluir más información del usuario
                'accountType' => $accountType,
            ],
        ];

        return JWT::encode($data, self::$secretKey, 'HS256');
    }

    public static function validateToken($token)
    {
        try {
            $decoded = JWT::decode($token, self::$secretKey, (object)['algorithm' => 'HS256']);

            // Verificar si el token ha expirado
            if (isset($decoded->exp) && $decoded->exp < time()) {
                return null; // Token expirado
            }

            // Agrega más verificaciones según sea necesario...

            return $decoded->data;
        } catch (Exception $e) {
            return null; // El token no es válido
        }
    }

}
?>
