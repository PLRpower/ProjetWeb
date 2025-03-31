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

    public function dernieresOffres(): void
    {

        $pagination = paginate(new Offer());
        echo $this->twig->render('dernieres-offres.twig', $pagination);
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
