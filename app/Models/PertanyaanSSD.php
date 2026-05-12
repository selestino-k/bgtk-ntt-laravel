<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanSSD extends Model
{
    protected $table = 'pertanyaan_ssds';

    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan'    => 'integer',
    ];
}
