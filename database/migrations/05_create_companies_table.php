<?php

require_once __DIR__ . '/../database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('companies', function ($table) {
    $table->id();
    $table->string('name');
    $table->text('description');
    $table->string('location');
    $table->string('email_contact');
    $table->string('telephone_contact');
    $table->timestamps();
});

echo "Table 'companies' créée !\n";