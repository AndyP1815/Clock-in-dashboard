<?php

namespace App\Models;

use App\Enums\Roles;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees'; // must match DB table exactly

    protected $primaryKey = 'id';
    protected $casts = [
        'role' => Roles::class,
    ];
    protected $fillable = [
        'employee_id',
        'name',
        'role'
    ];


    public function fingerprints()
    {
        return $this->hasMany(EmployeeFingerprint::class, 'employee_id', 'id');
    }

    public function clockIns()
    {
        return $this->hasMany(ClockIn::class, 'employee_id', 'id');
    }
}
