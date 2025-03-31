<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];
    protected $hidden = ['password'];

    public $timestamps = true;

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id');
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id');
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'id');
    }
}