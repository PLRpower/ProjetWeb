<?php

namespace App\Controllers;

use App\Models\Offer;
use App\Utils\Auth;

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
        $offers = Offer::all();
        $paginateOffers = paginate($offers);
        echo $this->twig->render('dernieres-offres.twig', $paginateOffers);
    }

    public function adminOffres(): void
    {
        if (Auth::checkRole(['teacher', 'admin'])) {
            $offers = Offer::all();
            $data = paginate($offers);
            $data['menu'] = 'offres';
            echo $this->twig->render('admin-offres.twig', $data);
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
            ]);
        }
    }

    public function supprimerOffre(): void
    {
        if (Auth::checkRole(['teacher', 'admin'])) {
            $offerId = validate_input($_POST['id'], 'int');
            $offer = Offer::findOrFail($offerId);
            $offer->delete();
            header('Location: /admin-offres');
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
            ]);
        }
    }
}
