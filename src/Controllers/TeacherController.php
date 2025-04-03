<?php

namespace App\Controllers;

use App\Models\Teacher;
use App\Utils\Auth;

class TeacherController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function adminPilotes(): void
    {
        if (Auth::checkRole(['admin'])) {
            $teachers = Teacher::all();
            $data = paginate($teachers);
            $data['menu'] = 'pilotes';
            echo $this->twig->render('admin-pilotes.twig', $data);
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
            ]);
        }
    }

    public function supprimerPilote(): void
    {
        if (Auth::checkRole(['admin'])) {
            $studentId = validate_input($_POST['id'], 'int');
            $student = Teacher::findOrFail($studentId);
            $student->delete();
            header('Location: /admin-pilotes');
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => 'Vous n\'avez pas les droits nécessaires pour accéder à cette page.'
            ]);
        }
    }
}
