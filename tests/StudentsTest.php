<?php

use App\Models\Student;
use App\Models\User;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/UsersTest.php';

function createRandomStudent(): ?Student
{
    $status = ['recherche', 'en cours', 'terminé'];
    $major = ['Informatique', 'BTP', 'Généraliste', 'Systèmes embarqués'];

    $user = User::whereDoesntHave('teacher')
        ->whereDoesntHave('student')
        ->whereDoesntHave('admin')
        ->first();
    if (!$user) {
        return null;
    }

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
    #[DependsExternal(UsersTest::class, 'testGetUser')]
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 20; $i++) {
            createRandomStudent();
        }
        Student::first()->user->update([
            'first_name' => "Jules",
            'last_name' => "Plüss",
            'email' => "jules@viacesi.fr",
            'password' => password_hash("student", PASSWORD_DEFAULT),
        ]);
    }

    #[DependsExternal(UsersTest::class, 'testGetUser')]
    public function testGetStudent()
    {
        $user = Student::first();
        $this->assertNotNull($user);
    }
}
