<?php

namespace App\Controllers;

use App\Models\Offer;
use App\Utils\Auth;

class HomeController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function accueil(): void
    {
        $offers = Offer::latest()->limit(4)->get();
        echo $this->twig->render('accueil.twig', ['offers' => $offers]);
    }

    public function admin(): void
    {
        echo $this->twig->render('admin.twig');
    }

    public function adminAccueil(): void
    {
        echo $this->twig->render('admin-accueil.twig');
    }

    public function wishlist(): void
    {
        echo $this->twig->render('wishlist.twig');
    }

    public function mentionsLegales(): void
    {
        echo $this->twig->render('mentions-legales.twig');
    }

    public function erreur($code, $message, $description): void
    {
        echo $this->twig->render('error.twig', ['message' => $message, 'code' => $code, 'description' => $description]);
    }

    public function dashboard(): void
    {
        if (Auth::isLogged()) {
            echo $this->twig->render('dashboard.twig', [
                'menu' => 'dashboard',
            ]);
        } else {
            header('Location: /connexion');
        }
    }
}
