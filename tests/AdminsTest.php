<?php

use App\Models\Admin;
use App\Models\User;
use PHPUnit\Framework\Attributes\DependsExternal;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/UsersTest.php';

function createRandomAdmin(): ?Admin
{
    $major = ['Informatique', 'BTP', 'Généraliste', 'Systèmes embarqués'];
    $specialization = ['IA', 'Génie civil', 'Réseaux', 'IoT', 'Cybersécurité', 'Big Data', 'DevOps', 'Cloud'];
    $office = ['B101', 'B102', 'B103', 'B104'];

    $user = User::whereDoesntHave('teacher')
        ->whereDoesntHave('student')
        ->whereDoesntHave('admin')
        ->first();
    if(!$user) {return null;}

    return Admin::create([
        'id' => $user->id,
        'department' => $major[array_rand($major)],
        'specialization' => $specialization[array_rand($specialization)],
        'office' => $office[array_rand($office)],
        'years_of_experience' => rand(0, 20),
    ]);}


class AdminsTest extends TestCase
{
    #[DependsExternal(UsersTest::class, 'testGetUser')]
    public static function setUpBeforeClass(): void
    {
        for ($i = 0; $i < 2; $i++) {
            createRandomAdmin();
        }
        Admin::first()->user->update([
            'first_name' => "Rémi",
            'last_name' => "Porcedda",
            'email' => "admin@cesi.fr",
            'password' => password_hash("admin", PASSWORD_DEFAULT),
            ]);
    }

    #[DependsExternal(UsersTest::class, 'testGetUser')]
    public function testGetTeacher()
    {
        $user = Admin::first();
        $this->assertNotNull($user);
    }
}
