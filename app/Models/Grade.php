<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = ['name', 'student_total', 'total_subject'];

    public function feeComponents()
    {
        return $this->hasMany(FeeComponent::class);
    }

    public function getTotalFeesAttribute()
    {

    }
}
