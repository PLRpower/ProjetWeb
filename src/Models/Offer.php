<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $connection = 'mysql';

    protected $table = 'offers';
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'duration',
        'remuneration',
        'location',
        'domain',
        'required_level',
    ];
    public $timestamps = true;
}