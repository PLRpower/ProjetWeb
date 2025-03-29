<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('teachers', function ($table) {
    $table->foreignId('id')->primary()->constrained('users')->onDelete('cascade');
    $table->string('department');
    $table->string('specialization');
    $table->string('office')->nullable();
    $table->integer('years_of_experience')->default(0);
});