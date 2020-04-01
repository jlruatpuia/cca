<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DDO extends Model
{
    protected $table = 'ddos';
    protected $fillable = [
        'ddo_code',
        'ddo_desc',
        'dept_code',
        'ddo_name',
        'treasury_code',
        'bank_code',
    ];
}
