<?php

use App\Models\Student;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/UsersTest.php';

function createRandomStudent(): Student
{
    $status = ['recherche', 'en cours', 'terminé'];
    $major = ['Informatique', 'BTP', 'Généraliste', 'Systèmes embarqués'];

    $user = createRandomUser();

    return Student::create([
        'id' => $user->id,
        'promotion' => 2020 + rand(0, 3),
        'major' => $major[array_rand($major)],
        'linkedin_url' => 'https://www.linkedin.com/in/' . uniqid(),
        'internship_status' => $status[array_rand($status)],
    ]);
}

class StudentsTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 30; $i++) {
            createRandomStudent();
        }
    }

    public function testGetStudent()
    {
        $user = Student::first();

        $this->assertNotNull($user);
    }
}
