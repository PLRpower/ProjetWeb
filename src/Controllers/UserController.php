<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function connexion(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            header('Content-Type: application/json');
            $email = validate_input($_POST['email'], 'email');
            $password = validate_input($_POST['password'], 'string');

            if ($email && $password) {
                $user = User::where('email', $email)->first();

                if ($user && password_verify($password, $user->password)) {
                    $_SESSION['user'] = $user;
                    echo json_encode(["success" => true]);
                    exit;
                } else {
                    echo json_encode(["success" => false, "message" => "Invalid email or password"]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Invalid input"]);
            }
        } 
    }
}
