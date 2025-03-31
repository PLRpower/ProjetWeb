<?php

namespace App\Controllers;

use App\Models\Student;
use App\Models\User;

class UserController extends Controller
{

    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function welcomePage(): void
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $students = Student::with('user')->limit($perPage)->offset($offset)->get();
        $total = User::count();
        $start = $offset + 1;
        $end = min($offset + $perPage, $total);

        echo $this->twig->render(
            'admin.twig',
            ['students' => $students, 'total' => $total, 'start' => $start, 'end' => $end]
        );
    }

    public function createUser(): void
    {
        $user = User::create([
            'email' => 'zqdqdz@gmail.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]);

        $student = Student::create([
            'id' => $user->id,
            'promotion' => '2023',
            'major' => 'Informatique',
            'linkedin_url' => 'https://www.linkedin.com/in/johndoe',
            'internship_status' => 'recherche',
        ]);
    }
}
