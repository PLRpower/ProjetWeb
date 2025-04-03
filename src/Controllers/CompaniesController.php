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

        // SELECT rating FROM evaluation WHERE id = $companiesId
        $company = Company::findOrFail($companiesId);

        // SELECT * FROM companies WHERE id != $companiesId ORDER BY created_at DESC LIMIT 2
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
        echo $this->twig->render('entreprises.twig', $paginateCompanies);
    }

    public function adminEntreprises(): void
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

    public function supprimerEntreprise(): void
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
}
