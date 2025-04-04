<?php
namespace Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth
{
    // get all data from JWT token
    public static function getAuthenticatedUser()
    {
        if (!isset($_SESSION["jwt"])) {
            return null; // No token found, user is not authenticated
        }

        $secretKey = getenv('JWT_SECRET_KEY') ?: ($_ENV['JWT_SECRET_KEY'] ?? null);
        if (!$secretKey) {
            throw new \Exception("JWT secret key is not set.");
        }

        try {
            $decoded = JWT::decode($_SESSION["jwt"], new Key($secretKey, 'HS256'));
            return (array) $decoded; // Return decoded payload as an array
        } catch (\Exception $e) {
            return null; // Invalid or expired token
        }
    }
}
