<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Profile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'sub_judul',
        'isi_konten',
        'gambar',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

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
