<?php

use Twig\Environment;
use Twig\Error\LoaderError;
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

$url = trim($_SERVER['REQUEST_URI'], '/');

$template = empty($url) ? 'accueil.twig' : "$url.twig";

try {
    echo $twig->render($template);
} catch (LoaderError $e) {
    echo $twig->render('error.twig');
}