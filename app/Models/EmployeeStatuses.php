<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatuses extends Model
{
    use HasFactory;

    protected $fillable=[
        'employee_id',
        'late_count'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
