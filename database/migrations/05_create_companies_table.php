<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('companies', function ($table) {
    $table->id();
    $table->string('name');
    $table->text('description');
    $table->string('location');
    $table->string('email_contact')->unique();
    $table->string('telephone_contact')->unique();
    $table->timestamps();
});