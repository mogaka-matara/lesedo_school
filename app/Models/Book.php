<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['book_name', 'book_no','author','publisher', 'subject', 'quantity', ];



    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function borrowings()
    {
        return $this->hasMany(BorrowBook::class);
    }

    public function isAvailable()
    {
        return !$this->borrowings()->whereNull('returned_date')->exists();
    }
}
