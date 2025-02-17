<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    protected $fillable = ['name', 'student_total', 'total_subject'];



    public function terms()
    {
        return $this->hasMany(Term::class);
    }
    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function feeComponents(): HasMany
    {
        return $this->hasMany(FeeComponent::class);
    }


    public function books()
    {
        return $this->hasMany(Book::class);
    }


}
