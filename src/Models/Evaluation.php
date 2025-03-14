<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $connection = 'mysql';

    protected $table = 'users';
    protected $fillable = [
        'rating',
        'comment',
    ];
    public $timestamps = false;
}