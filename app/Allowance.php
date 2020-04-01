<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allowance extends Model
{
    protected $fillable = [
        'allow_code', 'allow_name'
    ];
}
