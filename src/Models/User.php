<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    public $timestamps = true;
    protected $table = 'users';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];
    protected $hidden = ['password'];

    public function getRole()
    {
        if ($this->student()->exists()) {
            return 'student';
        } elseif ($this->teacher()->exists()) {
            return 'teacher';
        } elseif ($this->admin()->exists()) {
            return 'admin';
        }
        return null;
    }

    public function student(): HasOne
    {
        return $this->hasOne(Student::class, 'id');
    }

    public function teacher(): HasOne
    {
        return $this->hasOne(Teacher::class, 'id');
    }

    public function admin(): HasOne
    {
        return $this->hasOne(Admin::class, 'id');
    }
}