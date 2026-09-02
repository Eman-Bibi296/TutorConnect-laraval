<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'sender_type', 
        'receiver_type',
        'message',
        'is_read'
    ];

    /**
     * Relationship with student (when student is sender)
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'sender_id');
    }

    /**
     * Relationship with tutor (when tutor is sender)
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'sender_id');
    }

    /**
     * Get sender based on sender_type
     */
    public function sender()
    {
        if ($this->sender_type == 'student') {
            return $this->belongsTo(Student::class, 'sender_id');
        }
        return $this->belongsTo(Tutor::class, 'sender_id');
    }

    /**
     * Get receiver based on receiver_type
     */
    public function receiver()
    {
        if ($this->receiver_type == 'student') {
            return $this->belongsTo(Student::class, 'receiver_id');
        }
        return $this->belongsTo(Tutor::class, 'receiver_id');
    }
}