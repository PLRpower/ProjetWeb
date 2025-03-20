<?php

require_once __DIR__ . '/../database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('students', function ($table) {
    $table->foreignId('id')->primary()->constrained('users')->onDelete('cascade');
    $table->string('promotion');
    $table->string('major');
    $table->string('linkedin_url')->nullable();
    $table->enum('internship_status', ['recherche', 'en cours', 'terminé'])->default('recherche');
    $table->foreignId('teacher_id')->nullable()->constrained('teachers')->onDelete('set null');
});

echo "Table 'students' créé !\n";