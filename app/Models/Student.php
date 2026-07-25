<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['name', 'email', 'password', 'location'];
    
    public function requests()
    {
        return $this->hasMany(RequestModel::class);
    }
    
    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
