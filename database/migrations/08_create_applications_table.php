<?php

require_once __DIR__ . '/../database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('applications', function ($table) {
    $table->id();
    $table->string('cv');
    $table->string('cover_letter');
    $table->string('status');
    $table->string('email_application');
    $table->string('telephone_application');
    $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade');
    $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
    $table->timestamps();
});

echo "Table 'applications' créée !\n";


