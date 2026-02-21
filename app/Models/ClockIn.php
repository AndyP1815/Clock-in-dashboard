<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClockIn extends Model
{
    protected $table = 'clock_ins';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'status',
        'clock_in_time',
        'clock_out_time'
    ];

    protected $casts = [
        'clock_in_time' => 'datetime',
        'clock_out_time' => 'datetime',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
