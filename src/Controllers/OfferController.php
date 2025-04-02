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
                'wishlist' => $offer,
                'offers' => $offers
            ]
        );
    }

    public function dernieresOffres(): void
    {
        $offers = Offer::all();
        $paginateOffers = paginate($offers);
        echo $this->twig->render('dernieres-offres.twig', $paginateOffers);
    }
}
