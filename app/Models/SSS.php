<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SSS extends Model
{
    use HasFactory;

    protected $table='SSS';
    protected $fillable=[
        'id',
        'min_salary',
        'max_salary',
        'employee_has_to_pay',
    ];


}
