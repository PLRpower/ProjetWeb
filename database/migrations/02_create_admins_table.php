<?php

require_once __DIR__ . '/../database.php';

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::schema()->create('admins', function ($table) {
    $table->foreignId('id')->primary()->constrained('users')->onDelete('cascade');
});

echo "Table 'admins' créée !\n";