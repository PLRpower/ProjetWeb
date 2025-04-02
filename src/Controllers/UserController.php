<?php

namespace App\Controllers;

use App\Models\User;
use App\Utils\Auth;

class UserController extends Controller
{

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function connexion(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (Auth::isLogged()) {
                header('Location: /');
                exit;
            } else {
                echo $this->twig->render('connexion.twig');
            }
        } else {
            $email = validate_input($_POST['email'], 'email');
            $password = validate_input($_POST['password'], 'string');

            if (!$email) {
                echo json_encode(["success" => false, "message" => "Email invalide."]);
            } elseif (!$password) {
                echo json_encode(["success" => false, "message" => "Le mot de passe est requis."]);
            } else {
                $user = User::where('email', $email)->first();
                if ($user && password_verify($password, $user->password)) {
                    Auth::login($user);
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "message" => "Mauvais identifiant ou mot de passe."]);
                }
            }
        }
    }

    public function deconnexion(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
