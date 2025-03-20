<?php

require_once __DIR__ . '/../database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('evaluations', function ($table) {
    $table->id();
    $table->integer('rating');
    $table->text('comment');
    $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
});

echo "Table 'evaluations' créée !\n";