<?php

namespace App\Core\Middleware\Auth;

use Helpers\Auth;

class Authenticated implements AuthInterface
{
    private $allowed_routes = [
        '/ollivander',
        "/leaderboard",
        '/diagon-alley',
        '/enrolls',
        '/enroll',
        '/enroll/create',
        '/enroll/store',
        '/enroll/edit',
        '/enroll/update',
        '/enroll/delete',
        '/logout',
        "/quizz",
        "/profile",
        "/owl",
        "/chat",
        "/profile/edit",
        "/profile"
    ];

    public function handle($uri)
    {
        $role = $_SESSION['role'] ?? null; // Prevent undefined index errors
        $uri = trim($uri); // Normalize URI for consistency

        if (in_array($role, ['student', 'professor', 'headmaster'], true)) {
            if (!in_array($uri, $this->allowed_routes, true)) {
                return "403"; // Student trying to access restricted routes
            }
            return "200"; // Student is authorized
        }
        return "401"; // User not logged in
    }
}
