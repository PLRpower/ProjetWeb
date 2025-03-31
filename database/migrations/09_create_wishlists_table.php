<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('wishlists', function ($table) {
    $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
    $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade');
    $table->timestamps();

    $table->primary(['student_id', 'offer_id']);
});