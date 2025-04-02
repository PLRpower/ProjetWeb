<?php

namespace App\Controllers;

use App\Models\Student;
use App\Utils\Auth;

class StudentsController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function etudiants(): void
    {
        if (Auth::checkRole(['admin'])) {
            $students = Student::all();
            $data = paginate($students);
            $data['user'] = Auth::getUser();
            $data['page'] = 'etudiants';
            echo $this->twig->render('crud.twig', $data);
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => "Vous n'avez pas les droits nécessaires pour accéder à cette page."
            ]);
            exit;
        }
    }
}
