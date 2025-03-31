<?php

namespace App\Controllers;

use App\Models\Offer;

class OffersController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function detailsOffre(): void
    {
        $offerId = $_GET['id'] ?? null;
        $offer = Offer::findOrFail($offerId);
        echo $this->twig->render('details-offre.twig', ['offer' => $offer]);
    }

    public function dernieresOffres(): void
    {
        $pagination = paginate(new Offer());
        echo $this->twig->render('dernieres-offres.twig', $pagination);
    }
}
