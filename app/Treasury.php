<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Treasury extends Model
{
    protected $fillable = [
        'treasury_code', 'treasury_name', 'address'
    ];
}
