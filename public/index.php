<?php

use App\Controllers\HomeController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/database.php';
require_once __DIR__ . '/../src/Controllers/Pagination.php';

$loader = new FilesystemLoader([
    __DIR__ . '/../src/Views/pages',
    __DIR__ . '/../src/Views/components',
    __DIR__ . '/../src/Views/layouts',
]);

$twig = new Environment($loader, [
    'debug' => true,
    'cache' => false,
]);
setlocale(LC_TIME, 'fr_FR.utf8', 'fra');

error_reporting(E_ALL);
ini_set('display_errors', 1);

$url = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$homeController = new HomeController($twig);

switch ($url) {
    case '':
        $homeController->accueil();
        break;
    case 'dernieres-offres':
        $homeController->dernieresOffres();
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
        $homeController->connexion();
        break;
    case 'details-offre':
        $homeController->detailsOffre();
        break;
    case 'modif-profil':
        $homeController->modifProfil();
        break;
    case 'wishlist':
        $homeController->wishlist();
        break;
    default:
        $homeController->erreur();
        break;
}