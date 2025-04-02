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

    public function detailsEntreprises(): void
    {
        $companiesId = validate_input($_GET['id'], 'int');

        // SELECT rating FROM evaluation WHERE id = $companiesId
        $company = Company::findOrFail($companiesId);
        $rating = Evaluation::where('companyID', $companiesId);

        // SELECT * FROM companies WHERE id != $companiesId ORDER BY created_at DESC LIMIT 2
        $companies = Company::inRandomOrder()->where('id', '!=', $companiesId)->limit(2)->get();
        echo $this->twig->render(
            'details-entreprises.twig',
            [
                'company' => $company,
                'rating' => $rating,
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
