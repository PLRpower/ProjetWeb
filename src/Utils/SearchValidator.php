<?php

use App\Models\Teacher;
use App\Models\Student;
use App\Models\Admin;
use App\Models\Company;
use App\Models\Offer;

function SearchValidator($data, $tables =['Offer', 'Company'])
{
    $data = strip_tags($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    $data = explode(" ", $data);

    // Select all from offer join companies
    $query = $tables[0]::all();

    for ($i = 1; $i < count($tables); ++$i) {
        $query = $query->join($tables[$i])::all();
    }

    for ($i = 0; $i < count($data); ++$i) {         // chaque mot clé
        for ($j = 0; $j < count($data); ++$j) {     // chaque colonne d'une table
            $query = $query->where(column[$j] == $data[$i]);
        }
    }
    return $query;
}
