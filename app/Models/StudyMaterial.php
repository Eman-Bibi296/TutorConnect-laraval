<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    protected $fillable = [
        'tutor_id', 'title', 'material_type', 'description', 'file_path', 'file_name'
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }
}