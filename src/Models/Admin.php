<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $table = 'admins';
    protected $fillable = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function selectQuery($admin): string
    {
        return 'SELECT * FROM $admin';
    }
}