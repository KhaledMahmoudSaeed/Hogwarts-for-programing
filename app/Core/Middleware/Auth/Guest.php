<?php

namespace App\Core\Middleware\Auth;

use Helpers\Auth;

class Guest implements AuthInterface
{
    private $allowed_routes = [
        "/",
        "/home",
        "/about",
    ];

    private $guest_routes = [ // Fixed the typo
        "/",
        "/home",
        "/about",
        "/login",
        "/register",
    ];

    public function handle($uri)
    {
        $role = $_SESSION['role'] ?? "guest"; // Prevent undefined index errors
        $uri = trim($uri); // Normalize the URI

        if ($role === "guest") {
            if (!in_array($uri, $this->guest_routes, true)) {
                return "403"; // Guests can't access restricted routes
            }
            return "200"; // Guest can access allowed routes
        }

        if (in_array($role, ['student', 'professor', 'headmaster'], true)) {
            if (!in_array($uri, $this->allowed_routes, true)) {
                return "302"; // Redirect to dashboard for authenticated users
            }
            return "200"; // Authenticated user can access allowed routes
        }
        return "401"; // User is not logged in at all
    }
}
