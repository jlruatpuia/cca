<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable = [
        'dept_code',
        'desgn_code',
        'desgn_name',
        'pay_level',
    ];
}
