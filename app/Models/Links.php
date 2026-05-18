<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    //
    protected $table = 'links';

    protected $fillable = [
        'nama',
        'url',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
