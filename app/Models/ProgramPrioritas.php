<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProgramPrioritas extends Model
{
    protected $table = 'program_prioritas';
    protected $fillable = [
        'nama_program',
        'url',
        'gambar',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
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

        return asset('storage/' . $this->gambar);
    }

}
