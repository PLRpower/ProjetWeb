<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $connection = 'mysql';

    protected $table = 'users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'promotion',
        'major',
        'password'
    ];


    public $timestamps = true;
}