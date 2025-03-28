<?php

use App\Models\User;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';

function createRandomUser(): User
{
    $firstsNames = ['Amira', 'Sylvain', 'Hervé', 'Paul', 'Nicolas', 'Martin', 'Louis', 'Elodie', 'Jules', 'Kylian'];
    $lastNames = ['Thomas', 'Philip', 'Lambert', 'Plüss', 'Schnell', 'Game', 'Masson', 'Simon', 'Demessine', 'Leclerc'];

    $firstName = $firstsNames(array_rand($firstsNames));
    $lastName = $lastNames(array_rand($lastNames));
    return User::create([
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $firstName . '.' . $lastName . uniqid() . '@viacesi.fr',
        'password' => password_hash(uniqid(), PASSWORD_DEFAULT),
    ]);
}

class UsersTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        User::query()->delete();

        for ($i = 0; $i < 30; $i++) {
            createRandomUser();
        }
    }

    public static function tearDownAfterClass(): void
    {
        User::query()->delete();
    }

    public function testGetUser()
    {
        $user = User::first();

        $this->assertNotNull($user);
    }
}
