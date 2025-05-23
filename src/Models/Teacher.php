<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $table = 'teachers';
    protected $fillable = [
        'id',
        'department',
        'specialization',
        'office',
        'years_of_experience',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function ($user) {
            $user->teacher()->delete();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}