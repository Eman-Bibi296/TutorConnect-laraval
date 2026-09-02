<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'student_id',
        'tutor_id', 
        'rating',
        'comment',
        'status',
        'is_read'
    ];

    /**
     * Relationship: Feedback belongs to a Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Relationship: Feedback belongs to a Tutor
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
}