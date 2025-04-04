<?php

use App\Models\Teacher;
use App\Models\User;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/UsersTest.php';

function createRandomTeacher(): ?Teacher
{
    $major = ['Informatique', 'BTP', 'Généraliste', 'Systèmes embarqués'];
    $specialization = ['IA', 'Génie civil', 'Réseaux', 'IoT', 'Cybersécurité', 'Big Data', 'DevOps', 'Cloud'];
    $office = ['B101', 'B102', 'B103', 'B104'];

    $user = User::whereDoesntHave('teacher')
        ->whereDoesntHave('student')
        ->whereDoesntHave('admin')
        ->first();
    if (!$user) {
        return null;
    }

    return Teacher::create([
        'id' => $user->id,
        'department' => $major[array_rand($major)],
        'specialization' => $specialization[array_rand($specialization)],
        'office' => $office[array_rand($office)],
        'years_of_experience' => rand(0, 20),
    ]);
}

class TeachersTest extends TestCase
{
    #[DependsExternal(UsersTest::class, 'testGetUser')]
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 10; $i++) {
            createRandomTeacher();
        }
        Teacher::first()->user->update([
            'first_name' => "Amira",
            'last_name' => "Essaid-Farhat",
            'email' => "amira@cesi.fr",
            'password' => password_hash("teacher", PASSWORD_DEFAULT),
        ]);
    }

    public function testGetTeacher()
    {
        $user = Teacher::first();
        $this->assertNotNull($user);
    }
}
