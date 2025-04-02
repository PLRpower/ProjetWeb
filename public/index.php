<?php

use App\Controllers\HomeController;
use App\Controllers\OfferController;
use App\Controllers\StudentsController;
use App\Controllers\UserController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../src/Utils/Pagination.php';
require_once __DIR__ . '/../src/Utils/InputValidator.php';

$loader = new FilesystemLoader([
    __DIR__ . '/../src/Views/pages',
    __DIR__ . '/../src/Views/components',
    __DIR__ . '/../src/Views/layouts',
]);

$twig = new Environment($loader, [
    'debug' => true,
    'cache' => false,
]);

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$homeController = new HomeController($twig);
$offersController = new OfferController($twig);
$userController = new UserController($twig);
$studentsController = new StudentsController($twig);

switch ($url) {
    case '':
        $homeController->accueil();
        break;
    case 'dernieres-offres':
        $offersController->dernieresOffres();
        break;
    case 'mentions-legales':
        $homeController->mentionsLegales();
        break;
    case 'admin':
        $homeController->admin();
        break;
    case 'admin-accueil':
        $homeController->adminAccueil();
        break;
    case 'connexion':
        $userController->connexion();
        break;
    case 'details-offre':
        $offersController->detailsOffre();
        break;
    case 'modif-profil':
        $homeController->modifProfil();
        break;
    case 'wishlist':
        $homeController->wishlist();
        break;
    case 'deconnexion':
        $userController->deconnexion();
        break;
    case 'etudiants':
        $studentsController->etudiants();
        break;
    case 'dashboard':
        $homeController->dashboard();
        break;
    default:
        $homeController->erreur(
            '404',
            'Page non trouvée',
            "La page que vous cherchez n'existe pas ou a été déplacée. Veuillez vérifier l'URL et réessayer."
        );
        break;
}