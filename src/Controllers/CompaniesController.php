<?php

namespace App\Controllers;

use App\Models\Company;
use App\Models\Evaluation;

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
}
