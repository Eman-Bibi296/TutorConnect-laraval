<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id', 'receiver_id', 'sender_type', 
        'receiver_type', 'message'
    ];

    // Relationship with student (when student is sender)
    public function student()
    {
        return $this->belongsTo(Student::class, 'sender_id');
    }

    // Relationship with tutor (when tutor is sender)
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'sender_id');
    }

    // Get sender based on type
    public function sender()
    {
        if ($this->sender_type == 'student') {
            return $this->belongsTo(Student::class, 'sender_id');
        }
        return $this->belongsTo(Tutor::class, 'sender_id');
    }

    // Get receiver based on type
    public function receiver()
    {
        if ($this->receiver_type == 'student') {
            return $this->belongsTo(Student::class, 'receiver_id');
        }
        return $this->belongsTo(Tutor::class, 'receiver_id');
    }
}