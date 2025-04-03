<?php

namespace App\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Utils\Auth;

class StudentsController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function adminEtudiants(): void
    {
        if (Auth::checkRole(['teacher', 'admin'])) {
            $students = Student::all();
            $data = paginate($students);
            $data['menu'] = 'etudiants';
            echo $this->twig->render('admin-etudiants.twig', $data);
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => "Vous n'avez pas les droits nécessaires pour accéder à cette page."
            ]);
            exit;
        }
    }

    public function supprimerEtudiant(): void
    {
        if (Auth::checkRole(['teacher', 'admin'])) {
            $studentId = validate_input($_POST['id'], 'int');
            $student = User::findOrFail($studentId);
            $student->delete();
            header('Location: /admin-etudiants');
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
            ]);
        }
    }
}
