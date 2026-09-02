<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'subject',
        'qualification', 
        'experience',
        'location',
        'is_verified',
        'profile_picture', 
        'bio',
        'hourly_rate',
        'availability',
        'status'
    ];
    
    /**
     * Relationship: Tutor has many session bookings
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'tutor_id');
    }

    /**
     * Relationship: Tutor has many tuition requests
     */
    public function requests()
    {
        return $this->hasMany(RequestModel::class, 'tutor_id');
    }
    
    /**
     * Relationship: Tutor has many feedback/reviews received
     */
    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'tutor_id');
    }

    /**
     * Relationship: Tutor has many uploaded study materials
     */
    public function studyMaterials()
    {
        return $this->hasMany(StudyMaterial::class, 'tutor_id');
    }

    /**
     * Relationship: Tutor has many payment ledger records
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'tutor_id');
    }

    /**
     * Relationship: Messages sent by this tutor
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id')->where('sender_type', 'tutor');
    }

    /**
     * Relationship: Messages received by this tutor
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id')->where('receiver_type', 'tutor');
    }
    
    /**
     * Helper to compute average star rating safely
     */
    public function avgRating()
    {
        $avg = $this->feedback()->avg('rating');
        return $avg ? round($avg, 1) : 5.0;
    }
}