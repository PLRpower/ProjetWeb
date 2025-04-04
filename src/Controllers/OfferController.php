<?php

namespace App\Controllers;

use App\Models\Application;
use App\Models\Company;
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
        $offer = Offer::findOrFail($offerId);
        $offers = Offer::latest()->where('id', '!=', $offerId)->limit(2)->get();

        if(Auth::isLogged()) {
            $inWishlist = Application::where('student_id', Auth::getUser()->id)
                ->where('offer_id', $offerId)
                ->exists();
            echo $this->twig->render(
                'student-details-offre.twig',
                [
                    'offer' => $offer,
                    'offers' => $offers,
                    'inWishlist' => $inWishlist,
                ]
            );
        } else {
            echo $this->twig->render(
                'details-offre.twig',
                [
                    'offer' => $offer,
                    'offers' => $offers
                ]
            );        }
    }

    public function offres(): void
    {
        $offers = Offer::all();
        $paginateOffers = paginate($offers);
        if (Auth::isLogged()) {
            echo $this->twig->render('student-offres.twig', $paginateOffers);
        } else {
            echo $this->twig->render('offres.twig', $paginateOffers);
        }
    }

    public function afficher(): void
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

    public function supprimer(): void
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

    public function ajouter(): void
    {
        if (Auth::checkRole(['teacher', 'admin'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $offer = Offer::create([
                    'title' => validate_input($_POST['title'], 'string'),
                    'description' => validate_input($_POST['description'], 'string'),
                    'start_date' => validate_input($_POST['start_date'], 'date'),
                    'duration' => validate_input($_POST['duration'], 'string'),
                    'remuneration' => validate_input($_POST['remuneration'], 'float'),
                    'city' => validate_input($_POST['city'], 'string'),
                    'country' => validate_input($_POST['country'], 'string'),
                    'domain' => validate_input($_POST['domain'], 'string'),
                    'required_level' => validate_input($_POST['required_level'], 'string'),
                    'company_id' => validate_input($_POST['company_id'], 'int'),
                ]);
                header('Location: /admin-offres');
            } else {
                $companies = Company::all();
                echo $this->twig->render(
                    'ajouter-offre.twig',
                    ['companies' => $companies]
                );
            }
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
            ]);
        }
    }

    public function modifier(): void
    {
        if (Auth::checkRole(['teacher', 'admin'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $offerId = validate_input($_POST['id'], 'int');
                $offer = Offer::findOrFail($offerId);
                $offer->update([
                    'title' => validate_input($_POST['title'], 'string'),
                    'description' => validate_input($_POST['description'], 'string'),
                    'start_date' => validate_input($_POST['start_date'], 'date'),
                    'duration' => validate_input($_POST['duration'], 'string'),
                    'remuneration' => validate_input($_POST['remuneration'], 'float'),
                    'city' => validate_input($_POST['city'], 'string'),
                    'country' => validate_input($_POST['country'], 'string'),
                    'domain' => validate_input($_POST['domain'], 'string'),
                    'required_level' => validate_input($_POST['required_level'], 'string'),
                    'company_id' => validate_input($_POST['company_id'], 'int'),
                ]);
                header('Location: /admin-offres');
            } else {
                $offerId = validate_input($_GET['id'], 'int');
                $offer = Offer::findOrFail($offerId);
                $companies = Company::all();
                echo $this->twig->render('modifier-offre.twig', [
                    'offer' => $offer,
                    'companies' => $companies
                ]);
            }
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
            ]);
        }
    }

}