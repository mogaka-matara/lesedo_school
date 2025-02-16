<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'status'
    ];

    public function students():hasMany
    {
        return $this->hasMany(Student::class);
    }

    public function shouldBeActive(): bool
    {
        $today = Carbon::today();
        return $today->between($this->start_date, $this->end_date);
    }

    public static function updateActiveStatus()
    {
        $today = Carbon::today();

        self::query()->update(['status' => false]);

        $activeAcademicYear = self::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();
        if ($activeAcademicYear) {
            $activeAcademicYear->update(['status' => true]);
        }
    }

    public static function getActiveAcademicYear()
    {
        $today = Carbon::today();
        return self::whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->first();
    }
}
