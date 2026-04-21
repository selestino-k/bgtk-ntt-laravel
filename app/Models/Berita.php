<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Berita extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'gambar',
        'dokumen',
        'author_id',
        'published',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'berita_tag', 'berita_id', 'tag_id');
    }

    public function getGambarUrlAttribute(): ?string
    {
        if (! $this->gambar) {
            return null;
        }

        if (Str::startsWith($this->gambar, ['http://', 'https://'])) {
            return $this->gambar;
        }

        return Storage::url($this->gambar);
    }
}
