<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignerProduct extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];
}
