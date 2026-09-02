<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'student_id',
        'tutor_id',
        'preferred_date',
        'preferred_time',
        'mode',
        'sessions_per_week',
        'message',
        'topic',
        'amount',
        'status',
        'payment_status',
        'payment_id',
        'is_viewed',
        'student_viewed',
        'tutor_confirmed'
    ];

    /**
     * Relationship: Booking belongs to a Student
     */
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    /**
     * Relationship: Booking belongs to a Tutor
     */
    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }

    /**
     * Relationship: Booking has one Payment ledger record
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }

    /**
     * Mutator to safely convert UI time representations (e.g. "04:00 PM - 05:00 PM", "4:00 PM", "16:00")
     * into a valid MySQL TIME format (H:i:s).
     */
    public function setPreferredTimeAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['preferred_time'] = '16:00:00';
            return;
        }

        // If string contains a range like "04:00 PM - 05:00 PM", take the start part
        $parts = explode('-', (string)$value);
        $startStr = trim($parts[0]);

        $timestamp = strtotime($startStr);
        if ($timestamp !== false) {
            $this->attributes['preferred_time'] = date('H:i:s', $timestamp);
        } else {
            $this->attributes['preferred_time'] = '16:00:00';
        }
    }

    /**
     * Accessor to return friendly human-readable time range (e.g. "04:00 PM - 05:00 PM").
     */
    public function getFormattedTimeAttribute()
    {
        if (empty($this->preferred_time)) {
            return '04:00 PM - 05:00 PM';
        }

        try {
            $start = \Carbon\Carbon::parse($this->preferred_time);
            $end = (clone $start)->addHour();
            return $start->format('h:i A') . ' - ' . $end->format('h:i A');
        } catch (\Throwable $e) {
            return (string)$this->preferred_time;
        }
    }
}