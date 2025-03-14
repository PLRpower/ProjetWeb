<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'mysql';

    protected $table = 'companies';
    protected $fillable = [
        'name',
        'description',
        'location',
        'email_contact',
        'telephone_contact',
    ];
    public $timestamps = true;
}