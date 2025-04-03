<?php

use App\Controllers\CompaniesController;
use App\Controllers\HomeController;
use App\Controllers\OfferController;
use App\Controllers\StudentsController;
use App\Controllers\TeacherController;
use App\Controllers\UserController;
use App\Controllers\WishlistController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../src/Utils/Pagination.php';
require_once __DIR__ . '/../src/Utils/InputValidator.php';
require_once __DIR__ . '/../src/Utils/SearchValidator.php';


$loader = new FilesystemLoader([
    __DIR__ . '/../src/Views/pages',
    __DIR__ . '/../src/Views/components',
    __DIR__ . '/../src/Views/layouts',
]);

$twig = new Environment($loader, [
    'debug' => true,
    'cache' => false,
]);

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user'])) {
    $twig->addGlobal('user', $_SESSION['user']);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$homeController = new HomeController($twig);
$offersController = new OfferController($twig);
$companiesController = new CompaniesController($twig);
$userController = new UserController($twig);
$studentsController = new StudentsController($twig);
$wishlistController = new WishlistController($twig);
$teacherController = new TeacherController($twig);

switch ($url) {
    case '':
        $homeController->accueil();
        break;
    case 'dernieres-offres':
        $offersController->dernieresOffres();
        break;
    case 'entreprises':
        $companiesController->companies();
        break;
    case 'details-entreprise':
        $companiesController->detailsEntreprise();
        break;
    case 'mentions-legales':
        $homeController->mentionsLegales();
        break;
    case 'cgu':
        $homeController->cgu();
        break;
    case 'connexion':
        $userController->connexion();
        break;
    case 'details-offre':
        $offersController->detailsOffre();
        break;
    case 'modifier-profil':
        $userController->modifProfil();
        break;
    case 'wishlist':
        $wishlistController->wishlist();
        break;
    case 'ajouter-wishlist':
        $wishlistController->ajouterWishlist();
        break;
    case 'deconnexion':
        $userController->deconnexion();
        break;
    case 'admin-entreprises':
        $companiesController->adminEntreprises();
        break;
    case 'supprimer-entreprise':
        $companiesController->supprimerEntreprise();
        break;
    case 'ajouter-entreprise':
        $companiesController->ajouterEntreprise();
        break;
    case 'admin-pilotes':
        $teacherController->adminPilotes();
        break;
    case 'supprimer-pilote':
        $teacherController->supprimerPilote();
        break;
    case 'recherche':
        $homeController->recherche();
        break;
    case 'admin-offres':
        $offersController->adminOffres();
        break;
    case 'supprimer-offre':
        $offersController->supprimerOffre();
        break;
    case 'admin-etudiants':
        $studentsController->adminEtudiants();
        break;
    case 'supprimer-etudiant':
        $studentsController->supprimerEtudiant();
        break;
    case 'dashboard':
        $homeController->dashboard();
        break;
    case 'postuler':
        $homeController->postuler();
        break;
    default:
        $homeController->erreur(
            '404',
            'Page non trouvée',
            "La page que vous cherchez n'existe pas ou a été déplacée. Veuillez vérifier l'URL et réessayer."
        );
        break;
}