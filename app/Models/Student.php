<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'parent_name',
        'parent_contact',
        'parent_email',
        'amount_paid',
        'arrears',
        'status'
    ];


}
