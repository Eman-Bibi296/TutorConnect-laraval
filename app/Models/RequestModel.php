<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestModel extends Model
{
    protected $table = 'requests';
    
    protected $fillable = ['student_id', 'tutor_id', 'status'];
    
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}