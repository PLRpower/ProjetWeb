<?php

use App\Models\Application;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';

function createRandomApplication(): Application
{
    $student = createRandomStudent();
    $offer = createRandomOffer();

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
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 30; $i++) {
            createRandomApplication();
        }
    }

    public function testGetApplication()
    {
        $application = Application::first();

        $this->assertNotNull($application);
    }
}
