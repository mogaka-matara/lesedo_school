<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowBook extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'book_id', 'borrow_date', 'returned_date', 'status'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function bookGrade()
    {
        return $this->belongsTo(Grade::class, 'book_id', 'book_id');
    }

    public function isReturned()
    {
        return $this->status === true;
    }

}
