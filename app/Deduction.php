<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $fillable = [
        'deduction_code',
        'deduction_name',
        'grant_number',
        'account_head',
        'category',
    ];
}
