<?php

use App\Models\Company;
use App\Models\Offer;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/CompaniesTest.php';

function createRandomOffer(): ?Offer
{
    $title = ['Ingénieur', 'Développeur', 'Designer', 'Manager', 'Commercial', 'RH', 'Comptable', 'Juriste'];

    $city = [
        'Paris',
        'Lyon',
        'Marseille',
        'Toulouse',
        'Nice',
        'Nantes',
        'Strasbourg',
        'Montpellier',
        'Bordeaux',
        'Lille'
    ];

    $country = [
        'France',
        'Allemagne',
        'Italie',
        'Espagne',
        'Portugal',
        'Pays-Bas',
        'Royaume-Uni',
        'Irlande',
        'Danemark',
        'Suède'
    ];

    $domain = [
        'Informatique',
        'Finance',
        'Marketing',
        'Communication',
        'Ressources Humaines',
        'Juridique',
        'Comptabilité',
        'Logistique',
        'Achats',
        'Commercial'
    ];

    $requiredLevel = ['Bac', 'Bac +2', 'Bac +3', 'Bac +4', 'Bac +5'];

    $company = Company::inRandomOrder()->first();;
    if(!$company) {return null;}

    return Offer::create([
        'title' => $title[array_rand($title)],
        'description' => "Description de l'offre",
        'start_date' => date('Y-m-d', rand(1600995200, 1640995200)),
        'duration' => rand(1, 6),
        'remuneration' => rand(400, 3000),
        'city' => $city[array_rand($city)],
        'country' => $country[array_rand($country)],
        'domain' => $domain[array_rand($domain)],
        'required_level' => $requiredLevel[array_rand($requiredLevel)],
        'company_id' => $company->id
    ]);
}

class OffersTest extends TestCase
{
    #[DependsExternal(CompaniesTest::class, 'testGetCompany')]
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 60; $i++) {
            createRandomOffer();
        }
    }

    #[DependsExternal(CompaniesTest::class, 'testGetCompany')]
    public function testGetOffer()
    {
        $user = Offer::first();
        $this->assertNotNull($user);
    }
}
