<?php

use App\Models\Application;
use App\Models\Offer;
use App\Models\Student;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/OffersTest.php';
require_once __DIR__ . '/StudentsTest.php';

function createRandomApplication(): ?Application
{
    $offer = Offer::inRandomOrder()->first();
    $student = Student::inRandomOrder()->first();
    $application = Application::where('student_id', $student->id)
        ->where('offer_id', $offer->id)
        ->first();

    if ($application or !$offer or !$student) {
        return null;
    }

    return Application::create([
        'student_id' => $student->id,
        'offer_id' => $offer->id,
        'cv' => 'cv.pdf',
        'cover_letter' => 'lettre_de_motivation.pdf',
        'status' => 'en attente',
        'email_application' => 'application' . uniqid() . '@etu.com',
        'telephone_application' => uniqid()
    ]);
}

class ApplicationsTest extends TestCase
{
    #[DependsExternal(OffersTest::class, 'testGetOffer')]
    #[DependsExternal(StudentsTest::class, 'testGetStudent')]
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 30; $i++) {
            createRandomApplication();
        }
    }

    #[DependsExternal(OffersTest::class, 'testGetOffer')]
    #[DependsExternal(StudentsTest::class, 'testGetStudent')]
    public function testGetApplication()
    {
        $application = Application::first();
        $this->assertNotNull($application);
    }
}
