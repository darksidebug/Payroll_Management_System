<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'employee_id',
        'salary',
        'num_of_work_days'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
