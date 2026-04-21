<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Slideshow extends Model
{
    protected $fillable = [
        'judul',
        'deskripsi',
        'gambar',
        'urutan',
        'is_active',
    ];

    public function getGambarUrlAttribute(): ?string
    {
        if (! $this->gambar) {
            return null;
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://'])) {
            return $this->gambar;
        }

        if (Str::startsWith($this->gambar, '/storage/')) {
            return asset($this->gambar);
        }

        if (Storage::disk('public')->exists($this->gambar)) {
            return Storage::url($this->gambar);
        }

        return asset('img/' . $this->gambar);
    }
}