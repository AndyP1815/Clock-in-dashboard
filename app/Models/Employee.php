<?php

namespace App\Models;

use App\Enums\Roles;
use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee'; // must match DB table exactly
    public $timestamps = false;


    protected $primaryKey = 'id';
    protected $casts = [
        'role' => Roles::class,
    ];
    protected $fillable = [
        'employee_id',
        'name',
        'role'
    ];

    public function hasIssues(): bool
    {

        foreach ($this->clockIns as $clockIn) {

            if ($clockIn->status === Status::Failed || $clockIn->status === Status::Forgotten) {
                return true;
            }
        }

        return false;
    }


    public function fingerprints()
    {
        return $this->hasMany(EmployeeFingerprint::class, 'employee_id', 'id');
    }

    public function clockIns()
    {
        return $this->hasMany(ClockIn::class, 'employee_id', 'id');
    }
}
