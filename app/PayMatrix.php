<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayMatrix extends Model
{
    protected $fillable = [
        'pay_level',
        'pay_index',
        'basic_pay',
    ];
}
