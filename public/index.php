<?php

use App\Controllers\HomeController;
use App\Controllers\UserController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/database.php';


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

$url = trim($_SERVER['REQUEST_URI'], '/');

$controller = new UserController($twig);
$homeController = new HomeController($twig);

if ($url === '') {
    $controller->welcomePage();
} else {
    $homeController->erreur();
}