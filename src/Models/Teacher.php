<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    public $timestamps = false;
    protected $table = 'teachers';
    public $incrementing = false;
    protected $fillable = [
        'id',
        'department',
        'specialization',
        'office',
        'years_of_experience',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->teacher()->delete();
        });
    }
}