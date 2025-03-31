<?php

use App\Models\Evaluation;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/CompaniesTest.php';

function createRandomEvaluation(): Evaluation
{
    $company = createRandomCompany();

    return Evaluation::create([
        'rating' => rand(1, 5),
        'comment' => "Description de l'évaluation",
        'company_id' => $company->id
    ]);
}

class EvaluationsTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 10; $i++) {
            createRandomEvaluation();
        }
    }

    public function testGetEvaluation()
    {
        $user = Evaluation::first();

        $this->assertNotNull($user);
    }
}
