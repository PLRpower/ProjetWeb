<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $connection = 'mysql';

    protected $table = 'applications';
    protected $fillable = [
        'cv',
        'cover_letter',
        'status',
        'email_application',
        'telephone_application',
    ];
    public $timestamps = true;
}