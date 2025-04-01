<?php

namespace App\Controllers;

use App\Models\Offer;

class OfferController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function detailsOffre(): void
    {
        $offerId = validate_input($_GET['id'], 'int');

        // SELECT * FROM offers WHERE id = $offerId
        $offer = Offer::findOrFail($offerId);

        // SELECT * FROM offers WHERE id != $offerId ORDER BY created_at DESC LIMIT 2
        $offers = Offer::latest()->where('id', '!=', $offerId)->limit(2)->get();
        echo $this->twig->render(
            'details-offre.twig',
            [
                'offer' => $offer,
                'offers' => $offers
            ]
        );
    }

    public function dernieresOffres(): void
    {
        $pagination = paginate(new Offer());
        echo $this->twig->render('dernieres-offres.twig', $pagination);
    }
}
