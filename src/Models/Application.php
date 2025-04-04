<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Application extends Model
{
    public $timestamps = true;
    protected $table = 'applications';
    protected $fillable = [
        'cv',
        'cover_letter',
        'status',
        'email_application',
        'telephone_application',
        'offer_id',
        'student_id'
    ];

    public function offer(): BelongsTo
    {
        return $this->belongsTo(Offer::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}