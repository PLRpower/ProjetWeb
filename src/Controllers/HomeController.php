<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\Offer;
use App\Models\Student;
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

    public function wishlist(): void
    {
        echo $this->twig->render('wishlist.twig');
    }

    public function mentionsLegales(): void
    {
        echo $this->twig->render('mentions-legales.twig');
    }

    public function cgu(): void
    {
        echo $this->twig->render('cgu.twig');
    }

    public function erreur($code, $message, $description): void
    {
        echo $this->twig->render('error.twig', ['message' => $message, 'code' => $code, 'description' => $description]);
    }

    public function dashboard(): void
    {
        if (Auth::isLogged()) {
            $students = Student::all();
            $countFinished = $students->where('internship_status', 'terminé')->count();
            $countSearching = $students->where('internship_status', 'recherche')->count();
            $countInProgress = $students->where('internship_status', 'en cours')->count();
            echo $this->twig->render('dashboard.twig', [
                'menu' => 'dashboard',
                'countFinished' => $countFinished,
                'countSearching' => $countSearching,
                'countInProgress' => $countInProgress,
            ]);
        } else {
            header('Location: /connexion');
        }
    }

    public function postuler(): void
    {
        echo $this->twig->render('applied.twig');
    }

    public function recherche(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $search = validate_input($_POST['search'], 'string');
        } elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
            $search = validate_input($_GET['search'], 'string');
        }

        $offers = Offer::where('title', 'LIKE', "%$search%")->
        orWhere('description', 'LIKE', "%$search%")->
        orWhereHas('company', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%");
        })->get();
        $companies = Company::where('name', 'LIKE', "%$search%")->get();
        echo $this->twig->render('recherche.twig', [
            'offers' => $offers,
            'companies' => $companies,
        ]);
    }
}
