<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'requests';
    
    protected $fillable = [
        'student_id',
        'tutor_id',
        'status',
        'is_viewed'
    ];
    
    /**
     * Relationship: Request belongs to a Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    
    /**
     * Relationship: Request belongs to a Tutor
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
}