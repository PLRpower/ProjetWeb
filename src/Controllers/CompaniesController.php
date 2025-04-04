<?php

namespace App\Controllers;

use App\Models\Company;
use App\Utils\Auth;

class CompaniesController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
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

    public function companies(): void
    {
        $companies = Company::all();
        $paginateCompanies = paginate($companies);
        if(Auth::isLogged()) {
            echo $this->twig->render('student-entreprises.twig', $paginateCompanies);
        } else {
            echo $this->twig->render('entreprises.twig', $paginateCompanies);
        }
    }

    public function afficher(): void
    {
        if (Auth::checkRole(['teacher', 'admin'])) {
            $companies = Company::all();
            $data = paginate($companies);
            $data['menu'] = 'entreprises';
            echo $this->twig->render('admin-entreprises.twig', $data);
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
            $companyId = validate_input($_POST['id'], 'int');
            $company = Company::findOrFail($companyId);
            $company->delete();
            header('Location: /admin-entreprises');
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = validate_input($_POST['name'], 'string');
                $description = validate_input($_POST['description'], 'string');
                $location = validate_input($_POST['location'], 'string');
                $email_contact = validate_input($_POST['email_contact'], 'string');
                $telephone_contact = validate_input($_POST['telephone_contact'], 'string');

                $rating = validate_input($_POST['rating'], 'int');
                $comment = validate_input($_POST['comment'], 'string');

                $company = Company::create([
                    'name' => $name,
                    'description' => $description,
                    'location' => $location,
                    'email_contact' => $email_contact,
                    'telephone_contact' => $telephone_contact,
                ]);
                if ($rating && $comment) {
                    $company->evaluation()->create([
                        'rating' => $rating,
                        'comment' => $comment,
                    ]);
                }
                header('Location: /admin-entreprises');
            } else {
                echo $this->twig->render('ajouter-entreprise.twig');
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
                $companyId = validate_input($_POST['id'], 'int');
                $rating = validate_input($_POST['rating'], 'int');
                $comment = validate_input($_POST['comment'], 'string');

                $company = Company::findOrFail($companyId);
                $company->update([
                    'name' => validate_input($_POST['name'], 'string'),
                    'description' => validate_input($_POST['description'], 'string'),
                    'location' => validate_input($_POST['location'], 'string'),
                    'email_contact' => validate_input($_POST['email_contact'], 'string'),
                    'telephone_contact' => validate_input($_POST['telephone_contact'], 'string'),
                ]);

                if ($rating && $comment) {
                    $company->evaluation()->updateOrCreate(
                        ['company_id' => $companyId],
                        ['rating' => $rating, 'comment' => $comment,]
                    );
                }


                header('Location: /admin-entreprises');
            } else {
                $companyId = validate_input($_GET['id'], 'int');
                $company = Company::findOrFail($companyId);
                echo $this->twig->render('modifier-entreprise.twig', [
                    'company' => $company
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
