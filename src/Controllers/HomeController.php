<?php

namespace App\Controllers;

use App\Models\Offer;

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

    public function connexion(): void
    {
        echo $this->twig->render('connexion.twig');
    }

    public function modifProfil(): void
    {
        echo $this->twig->render('modif-profil.twig');
    }

    public function wishlist(): void
    {
        echo $this->twig->render('wishlist.twig');
    }

    public function mentionsLegales(): void
    {
        echo $this->twig->render('mentions-legales.twig');
    }

    public function erreur(): void
    {
        echo $this->twig->render('error.twig');
    }
}
