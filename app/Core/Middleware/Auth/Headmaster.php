<?php

namespace App\Core\Middleware\Auth;

use Helpers\Auth;

class Headmaster
{
    private $allowed_routes = [
        //headmaster
        '/dashboard/user/promote',
        '/dashboard/user/demote',
    ];

    public function handle($uri)
    {
        $role = $_SESSION['role'] ?? null; // Avoid undefined index error
        if ($role === "headmaster") {
            if (!in_array(trim($uri), $this->allowed_routes, true)) {
                return "403"; // Forbidden
            }
            return "200"; // Authorized
        } else {
            return "403"; // Unauthorized
        }
    }

}