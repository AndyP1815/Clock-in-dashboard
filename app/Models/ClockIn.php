<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class ClockIn extends Model
{
    protected $table = 'clock_in';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'status',
        'clock_in_time',
        'clock_out_time'
    ];

    protected static function booted(): void
    {
        static::saving(function ($clockIn) {
            $clockIn->status = Status::Done->value;
        });
    }
    protected $casts = [
        'clock_in_time' => 'datetime',
        'clock_out_time' => 'datetime',
        'status' => Status::class,
    ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
