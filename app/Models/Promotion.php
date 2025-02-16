<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'current_grade_id', 'next_grade_id', 'current_academic_year_id','next_academic_year_id'];



    public function currentGrade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'current_grade_id');
    }

    public function newGrade(): BelongsTo
    {
        return $this->belongsTo(Grade::class, 'next_grade_id');
    }

    public function currentAcademicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'current_academic_year_id');
    }

    public function nextAcademicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class, 'next_academic_year_id');
    }


}
