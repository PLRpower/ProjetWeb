<?php

namespace App\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Utils\Auth;

class TeacherController extends Controller
{
    public function __construct($twig)
    {
        $this->twig = $twig;
    }

    public function afficher(): void
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

    public function supprimer(): void
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

    public function ajouter(): void
    {
        if (Auth::checkRole(['admin'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = User::create([
                    'first_name' => validate_input($_POST['first_name'], 'string'),
                    'last_name' => validate_input($_POST['last_name'], 'string'),
                    'email' => validate_input($_POST['email'], 'string'),
                    'password' => password_hash(validate_input($_POST['password'], 'string'), PASSWORD_DEFAULT),
                ]);
                Teacher::create([
                    'id' => $user->id,
                    'department' => validate_input($_POST['department'], 'string'),
                    'specialization' => validate_input($_POST['specialization'], 'string'),
                    'office' => validate_input($_POST['office'], 'string'),
                    'years_of_experience' => validate_input($_POST['years_of_experience'], 'int')
                ]);
                header('Location: /admin-pilotes');
            } else {
                echo $this->twig->render('ajouter-pilote.twig');
            }
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => "Vous n'avez pas les droits nécessaires pour accéder à cette page."
            ]);
        }
    }

    public function modifier(): void
    {
        if (Auth::checkRole(['admin'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $teacherId = validate_input($_POST['id'], 'int');
                $teacher = Teacher::findOrFail($teacherId);
                $user = User::findOrFail($teacher->id);
                $user->update([
                    'first_name' => validate_input($_POST['first_name'], 'string'),
                    'last_name' => validate_input($_POST['last_name'], 'string'),
                    'email' => validate_input($_POST['email'], 'string'),
                    'password' => password_hash(validate_input($_POST['password'], 'string'), PASSWORD_DEFAULT),
                ]);
                $teacher->update([
                    'department' => validate_input($_POST['department'], 'string'),
                    'specialization' => validate_input($_POST['specialization'], 'string'),
                    'office' => validate_input($_POST['office'], 'string'),
                    'years_of_experience' => validate_input($_POST['years_of_experience'], 'int')
                ]);
                header('Location: /admin-pilotes');
            } else {
                $teacherId = validate_input($_GET['id'], 'int');
                $teacher = Teacher::findOrFail($teacherId);
                echo $this->twig->render('modifier-pilote.twig', [
                    'teacher' => $teacher
                ]);
            }
        } else {
            echo $this->twig->render('error.twig', [
                'message' => 'Accès refusé',
                'code' => 403,
                'description' => "Vous n'avez pas les droits nécessaires pour accéder à cette page."
            ]);
        }
    }
}
