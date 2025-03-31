<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('applications', function ($table) {
    $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
    $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade');
    $table->string('cv');
    $table->string('cover_letter');
    $table->enum('status', ['en attente', 'accepté', 'refusé'])->default('en attente');
    $table->string('email_application')->nullable();
    $table->string('telephone_application')->nullable();
    $table->timestamps();

    $table->primary(['student_id', 'offer_id']);
});

