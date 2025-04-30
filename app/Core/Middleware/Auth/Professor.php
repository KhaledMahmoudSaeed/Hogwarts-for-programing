<?php

namespace App\Core\Middleware\Auth;

use Helpers\Auth;

class Professor
{
    private $allowed_routes = [
        "/dashboard",
        // users
        '/dashboard/users',
        '/dashboard/user',
        '/dashboard/user/create',
        '/dashboard/user/store',
        '/dashboard/user/edit',
        '/dashboard/user/update',
        '/dashboard/user/delete',
        // courses
        '/dashboard/courses',
        '/dashboard/course',
        '/dashboard/course/create',
        '/dashboard/course/store',
        '/dashboard/course/edit',
        '/dashboard/course/update',
        '/dashboard/course/delete',
        //quizzs
        '/dashboard/quizzs',
        '/dashboard/quizz',
        '/dashboard/quizz/create',
        '/dashboard/quizz/store',
        '/dashboard/quizz/edit',
        '/dashboard/quizz/update',
        '/dashboard/quizz/delete',
        //purchases
        '/dashboard/purchases',
        '/dashboard/purchase',
        '/dashboard/purchase/create',
        '/dashboard/purchase/store',
        '/dashboard/purchase/edit',
        '/dashboard/purchase/update',
        '/dashboard/purchase/delete',
    ];

    public function handle($uri)
    {
        $role = $_SESSION['role'] ?? null; // Avoid undefined index error
        if (in_array($role, ['professor', 'headmaster'], true)) {
            if (!in_array(trim($uri), $this->allowed_routes, true)) {
                return "403"; // Forbidden
            }
            return "200"; // Authorized
        } else {
            return "403"; // Unauthorized
        }
    }

}