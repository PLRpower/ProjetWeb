<?php

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../database/database.php';

class UserTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        $firstsNames = [
            'Amira',
            'Sylvain',
            'Pierre',
            'Paul',
            'Nicolas',
            'Martin',
            'Louis',
            'Elodie',
            'Jüles',
            'Kylian'
        ];
        $lastNames = [
            'Thomas',
            'Philip',
            'Lambert',
            'Pluss',
            'Moreau',
            'Simon',
            'Laurent',
            'Lefebvre',
            'Roux',
            'Leclerc'
        ];
        $status = ['recherche', 'en cours', 'terminé'];
        $major = ['Informatique', 'BTP', 'Généraliste', 'Systèmes embarqués'];

        for ($i = 0; $i < 30; $i++) {
            $firstName = array_rand($firstsNames);
            $lastName = array_rand($lastNames);
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => strtolower($firstName) . '.' . strtolower($lastName) . $user->id . '@viacesi.fr',
                'password' => password_hash(random_bytes(10), PASSWORD_DEFAULT),
            ]);
        }

        Admin::create([
            'user_id' => 1,
        ]);

        for ($i = 2; $i < 10; $i++) {
            Teacher::create([
                'id' => $i + 1,
                'promotion' => 2020 + rand(0, 3),
                'major' => $major[rand(0, 3)],
                'linkedin_url' => 'https://www.linkedin.com/in/' . $firstsNames[rand(0, 9)] . $lastNames[rand(0, 9)],
                'internship_status' => $status[rand(0, 2)],
                'teacher_id' => rand(1, 10),
            ]);
        }

        for ($i = 10; $i < 30; $i++) {
            Student::create([
                'id' => $i + 1,
                'promotion' => 2020 + rand(0, 3),
                'major' => $major[rand(0, 3)],
                'linkedin_url' => 'https://www.linkedin.com/in/' . $firstsNames[rand(0, 9)] . $lastNames[rand(0, 9)],
                'internship_status' => $status[rand(0, 2)],
                'teacher_id' => rand(1, 10),
            ]);
        }
    }

    public function testGetUser()
    {
        $user = User::all()->first();
        $this->assertNotNull($user);
    }

    public function testGetTeacher()
    {
        $teacher = Teacher::all()->first();
        $this->assertNotNull($teacher);
    }

    public function testGetStudent()
    {
        $student = Student::all()->first();
        $this->assertNotNull($student);
    }

    public function testGetAdmin()
    {
        $admin = Admin::all()->first();
        $this->assertNotNull($admin);
    }
}
