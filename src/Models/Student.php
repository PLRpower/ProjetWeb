<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    public $timestamps = false;
    protected $table = 'students';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'promotion',
        'major',
        'linkedin_url',
        'internship_status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class);
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }
}