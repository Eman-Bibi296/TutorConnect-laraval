<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'student_id',
        'tutor_id',
        'amount',
        'currency',
        'transaction_id',
        'status'
    ];

    /**
     * Relationship: Payment belongs to a Booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    /**
     * Relationship: Payment belongs to a Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Relationship: Payment belongs to a Tutor
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }
}