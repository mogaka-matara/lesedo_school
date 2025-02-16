<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Term extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date'
    ];




    public function studentTermFees(): HasMany
    {
        return $this->hasMany(StudentTermFee::class);
    }

    public function feeComponents(): HasMany
    {
        return $this->hasMany(FeeComponent::class);
    }



    public function isActive()
    {
        $today = Carbon::today();
        return $this->is_active && $today->between($this->start_date, $this->end_date);
    }


    public static function getActiveTerm(): ?self
    {
        $currentMonth = Carbon::now()->format('m');
        $currentYear = Carbon::now()->format('Y');

        return self::whereRaw("YEAR(start_date) = ? AND MONTH(start_date) <= ? AND MONTH(end_date) >= ?", [$currentYear, $currentMonth, $currentMonth])
            ->first();
    }
}
