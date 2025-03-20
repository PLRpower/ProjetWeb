<?php

require_once __DIR__ . '/../database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('offers', function ($table) {
    $table->id();
    $table->string('title');
    $table->text('description');
    $table->date('start_date');
    $table->string('duration');
    $table->decimal('remuneration', 10, 2);
    $table->string('city');
    $table->string('country');
    $table->string('domain');
    $table->string('required_level');
    $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
    $table->timestamps();
});

echo "Table 'offers' créée !\n";