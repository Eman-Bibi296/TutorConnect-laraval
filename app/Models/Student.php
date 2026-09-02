<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'location'
    ];
    
    /**
     * Relationship: Student has many session bookings
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'student_id');
    }

    /**
     * Relationship: Student has many tuition requests
     */
    public function requests()
    {
        return $this->hasMany(RequestModel::class, 'student_id');
    }
    
    /**
     * Relationship: Student has many reviews/feedback given
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'student_id');
    }

    /**
     * Relationship: Student has many payment ledger records
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'student_id');
    }

    /**
     * Relationship: Messages sent by this student
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id')->where('sender_type', 'student');
    }

    /**
     * Relationship: Messages received by this student
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id')->where('receiver_type', 'student');
    }
}
