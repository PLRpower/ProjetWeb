<?php

require_once __DIR__ . '/../database.php';
require_once __DIR__ . '/../../vendor/autoload.php';

$migrations = [
    '01_create_users_table.php',
    '02_create_admins_table.php',
    '03_create_teachers_table.php',
    '04_create_students_table.php',
    '05_create_companies_table.php',
    '06_create_evaluations_table.php',
    '07_create_offers_table.php',
    '08_create_applications_table.php',
    '09_create_wishlists_table.php'
];

foreach ($migrations as $migration) {
    include __DIR__ . "/{$migration}";
    echo "Migration {$migration} exécutée\n";
}
