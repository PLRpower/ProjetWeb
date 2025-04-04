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

    public function afficher(): void
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

    public function supprimer(): void
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

    public function ajouter(): void
    {
        if (Auth::checkRole(['admin', 'teacher'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $user = User::create([
                    'first_name' => validate_input($_POST['first_name'], 'string'),
                    'last_name' => validate_input($_POST['last_name'], 'string'),
                    'email' => validate_input($_POST['email'], 'string'),
                    'password' => password_hash(validate_input($_POST['password'], 'string'), PASSWORD_DEFAULT),
                ]);
                Student::create([
                    'id' => $user->id,
                    'promotion' => validate_input($_POST['promotion'], 'string'),
                    'major' => validate_input($_POST['major'], 'string'),
                    'linkedin_url' => validate_input($_POST['linkedin_url'], 'string'),
                    'internship_status' => validate_input($_POST['internship_status'], 'string'),
                ]);
                header('Location: /admin-etudiants');
            } else {
                echo $this->twig->render('ajouter-etudiant.twig');
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
        if (Auth::checkRole(['admin', 'teacher'])) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $studentId = validate_input($_POST['id'], 'int');
                $student = Student::findOrFail($studentId);
                $user = User::findOrFail($student->id);
                $user->update([
                    'first_name' => validate_input($_POST['first_name'], 'string'),
                    'last_name' => validate_input($_POST['last_name'], 'string'),
                    'email' => validate_input($_POST['email'], 'string'),
                    'password' => password_hash(validate_input($_POST['password'], 'string'), PASSWORD_DEFAULT),
                ]);
                $student->update([
                    'promotion' => validate_input($_POST['promotion'], 'string'),
                    'major' => validate_input($_POST['major'], 'string'),
                    'linkedin_url' => validate_input($_POST['linkedin_url'], 'string'),
                    'internship_status' => validate_input($_POST['internship_status'], 'string'),
                ]);
                header('Location: /admin-etudiants');
            } else {
                $studentId = validate_input($_GET['id'], 'int');
                $student = Student::findOrFail($studentId);
                $applications = $student->applications()->get();
                echo $this->twig->render('modifier-etudiant.twig', [
                    'student' => $student,
                    'applications' => $applications,
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
