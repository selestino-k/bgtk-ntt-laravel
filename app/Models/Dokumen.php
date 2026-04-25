<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $table = 'dokumen';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_url',
        'file_name',
        'file_size',
        'file_type',
        'kategori',
    ];
}
