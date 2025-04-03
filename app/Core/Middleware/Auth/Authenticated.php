<?php

namespace App\Core\Middleware\Auth;

use Helpers\Auth;

class Authenticated implements AuthInterface
{
    private $allowed_routes = [
        "/",
        "/home",
        "/about",
        '/ollivander',
        "/leaderboard",
        '/items',
        '/enrolls',
        '/enroll',
        '/enroll/create',
        '/enroll/store',
        '/enroll/edit',
        '/enroll/update',
        '/enroll/delete',
        '/logout',
        "/quizz"
    ];

    public function handle($uri)
    {
        $role = $_SESSION['role'] ?? null; // Prevent undefined index errors
        $uri = trim($uri); // Normalize URI for consistency
        if ($role === "student") {
            if (!in_array($uri, $this->allowed_routes, true)) {
                return "403"; // Student trying to access restricted routes
            }
            return "200"; // Student is authorized
        }
        return "401"; // User not logged in
    }
}
