<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benifits extends Model
{
    use HasFactory;

    protected $fillable=[
        'sss',
        'philhealth',
        'gsis',
        'pag_ibig'
    ];
}