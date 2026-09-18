<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetOtp extends Model
{
    protected $fillable = ['email', 'user_type', 'otp', 'expires_at'];
    protected $casts = ['expires_at' => 'datetime'];
}