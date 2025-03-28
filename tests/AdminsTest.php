<?php

use App\Models\Admin;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/UsersTest.php';

function createRandomAdmin(): Admin
{
    $major = ['Informatique', 'BTP', 'Généraliste', 'Systèmes embarqués'];
    $specialization = ['IA', 'Génie civil', 'Réseaux', 'IoT', 'Cybersécurité', 'Big Data', 'DevOps', 'Cloud'];
    $office = ['B101', 'B102', 'B103', 'B104'];

    $user = createRandomUser();

    return Admin::create([
        'id' => $user->id,
        'department' => $major[array_rand($major)],
        'specialization' => $specialization[array_rand($specialization)],
        'office' => $office[array_rand($office)],
        'years_of_experience' => rand(0, 20),
    ]);
}

class AdminsTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 2; $i++) {
            createRandomAdmin();
        }
    }

    public function testGetTeacher()
    {
        $user = Admin::first();

        $this->assertNotNull($user);
    }
}
