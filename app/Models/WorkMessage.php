<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkMessage extends Model
{
    protected $table = 'work_message';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'message',
        'is_end',
    ];

    protected $casts = [
        'is_end' => 'boolean',
    ];

    public function employees()
    {
        return $this->belongsToMany(
            Employee::class,
            'employee_work_message',
            'work_message_id',
            'employee_id'
        );
    }
}
