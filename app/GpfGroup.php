<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GpfGroup extends Model
{
    protected $fillable = [
        'group_id', 'group_name', 'department_id'
    ];
}
