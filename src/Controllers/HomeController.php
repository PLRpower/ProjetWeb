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
        Offer::limit(4);
        echo $this->twig->render('accueil.twig');
    }

    public function erreur(): void
    {
        echo $this->twig->render('error.twig');
    }
}
