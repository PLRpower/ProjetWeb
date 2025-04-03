<?php

use App\Models\Company;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';

function createRandomCompany(): Company
{
    $name = ['Google', 'Apple', 'Facebook', 'Amazon', 'Microsoft', 'Mundo Economics', 'LinkedIn', 'Moodle', 'Siemens'];
    $location = ['Paris', 'Lyon', 'Marseille', 'Toulouse', 'Nice', 'Nantes', 'Strasbourg', 'Montpellier', 'Bordeaux'];

    $name = $name[array_rand($name)];

    return Company::create([
        'name' => $name,
        'description' => 'Description de ' . $name,
        'location' => $location[array_rand($location)],
        'email_contact' => 'contact' . uniqid() . '@' . strtolower($name) . '.com',
        'telephone_contact' => uniqid()
    ]);
}

class CompaniesTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 30; $i++) {
            createRandomCompany();
        }
    }

    public function testGetCompany()
    {
        $user = Company::first();
        $this->assertNotNull($user);
    }
}
