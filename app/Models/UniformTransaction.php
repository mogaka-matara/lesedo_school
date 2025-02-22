<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UniformTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'components',
        'total_price',
        'issue_date'
    ];

    protected $casts = [
        'components' => 'array',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
