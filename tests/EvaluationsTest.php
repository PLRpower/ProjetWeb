<?php

use App\Models\Company;
use App\Models\Evaluation;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/CompaniesTest.php';

function createRandomEvaluation(): ?Evaluation
{
    $company = Company::whereDoesntHave('evaluation')->first();
    if(!$company) {return null;}

    return Evaluation::create([
        'rating' => rand(1, 5),
        'comment' => "Description de l'évaluation",
        'company_id' => $company->id
    ]);
}

class EvaluationsTest extends TestCase
{
    #[DependsExternal(CompaniesTest::class, 'testGetCompany')]
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 30; $i++) {
            createRandomEvaluation();
        }
    }

    #[DependsExternal(CompaniesTest::class, 'testGetCompany')]
    public function testGetEvaluation()
    {
        $user = Evaluation::first();
        $this->assertNotNull($user);
    }
}
