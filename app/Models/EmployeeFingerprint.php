<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeFingerprint extends Model
{
    protected $table = 'employee_fingerprints';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'fingerprint'
    ];

    public function employee(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
