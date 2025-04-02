<?php

namespace App\Utils;

use App\Models\User;

class Auth
{

    public static function login($user): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['user'] = $user;
    }

    public static function logout(): void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        unset($_SESSION['user']);
        session_destroy();
    }

    public static function isLogged(): bool
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['user']);
    }

    public static function checkRole($roles): bool
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        $user = $_SESSION['user'] ?? null;
        $role = $user ? $user->getRole() : null;
        return $role && in_array($role, (array)$roles);
    }

    public static function getUser(): ?User
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        return $_SESSION['user'] ?? null;
    }
}
