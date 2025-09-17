<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'place_of_birth',
        'age',
        'sex',
        'address',
        'job_title',
        'department',
        'status',
        'date_of_service',
        'salary',
    ];

}
