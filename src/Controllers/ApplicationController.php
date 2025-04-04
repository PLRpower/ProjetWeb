<?php

namespace App\Controllers;

use App\Models\Application;
use App\Models\Company;
use App\Models\Offer;
use App\Utils\Auth;

class ApplicationController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function postuler(): void
    {
        if(Auth::isLogged()) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $offerId = validate_input($_POST['id'], 'int');
                $userId = Auth::getUser()->id;

                $target_dir = "uploads/cv/";
                $fileExtension = pathinfo($_FILES["cv"]["name"], PATHINFO_EXTENSION);
                $uniqueFileName = uniqid() . '.' . $fileExtension;
                $target_file = $target_dir . $uniqueFileName;
                move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file);

                Application::create([
                    'student_id' => $userId,
                    'offer_id' => $offerId,
                    'cv' => $target_file,
                    'cover_letter' => validate_input($_POST["cover_letter"], 'string'),
                    'status' => 'en attente',
                    'email_application' => validate_input($_POST["email_application"], 'string'),
                    'telephone_application' => validate_input($_POST["telephone_application"], 'string'),
                ]);

                header('Location: /wishlist' . $offerId);
                exit;
            } else {
                $offerId = validate_input($_GET['id'], 'int');
                $offer = Offer::findOrFail($offerId);
                if($offer)
                echo $this->twig->render('candidature.twig', [
                    'offer' => $offer
                ]);
            }
        } else {
            header('Location: /connexion');
            exit;
        }
    }

    public function detailsEntreprise(): void
    {
        $companiesId = validate_input($_GET['id'], 'int');

        $company = Company::findOrFail($companiesId);
        $companies = Company::inRandomOrder()->where('id', '!=', $companiesId)->limit(2)->get();
        echo $this->twig->render(
            'details-entreprise.twig',
            [
                'company' => $company,
                'others' => $companies
            ]
        );
    }
}
