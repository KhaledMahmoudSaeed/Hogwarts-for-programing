<?php
namespace App\Core\Middleware\Auth;
interface AuthInterface
{
    public function handle($uri);
}