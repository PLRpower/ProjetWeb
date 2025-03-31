<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'name',
        'description',
        'location',
        'email_contact',
        'telephone_contact',
    ];
    public $timestamps = true;

    public function evaluations(): HasOne
    {
        return $this->hasOne(Evaluation::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }
}