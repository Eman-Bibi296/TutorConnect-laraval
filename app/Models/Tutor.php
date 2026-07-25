<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    protected $fillable = ['name', 'email', 'password', 'subject', 'qualification', 'experience', 'location', 'is_verified'];
    
    public function requests()
    {
        return $this->hasMany(RequestModel::class);
    }
    
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
    
    public function avgRating()
    {
        return $this->feedback()->avg('rating');
    }
}