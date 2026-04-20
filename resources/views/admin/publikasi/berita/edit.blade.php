@extends('admin.layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Publikasi: Berita Terkini</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Edit Berita</h1>
        </div>
        <a href="{{ route('admin.publikasi.berita.show', $berita) }}" class="btn btn-outline gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="hidden sm:inline">Kembali</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="card border border-base-300 shadow-sm bg-base-100">
        <div class="card-body">
            <form action="{{ route('admin.publikasi.berita.update', $berita) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PATCH')

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Judul</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required class="input input-bordered w-full" />
                    @error('judul')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Slug (otomatis dari judul)</span></label>
                    <p id="slug-preview" class="rounded-lg border border-base-300 bg-base-200 px-4 py-3 text-sm text-base-content/70">
                        {{ old('judul', $berita->judul) ? \Illuminate\Support\Str::slug(old('judul', $berita->judul)) : 'Slug akan muncul di sini setelah mengisi judul.' }}
                    </p>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Isi Berita</span></label>
                    <textarea name="isi" rows="8" required class="textarea textarea-bordered w-full">{{ old('isi', $berita->isi) }}</textarea>
                    @error('isi')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Gambar (URL atau upload)</span></label>
                    <input type="text" name="gambar" value="{{ old('gambar', $berita->gambar) }}" placeholder="URL gambar" class="input input-bordered w-full" />
                    <input type="file" name="gambar_file" accept="image/*" class="file-input file-input-bordered w-full mt-2" />
                    @error('gambar')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    @error('gambar_file')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Dokumen (URL atau upload)</span></label>
                    <input type="text" name="dokumen" value="{{ old('dokumen', $berita->dokumen) }}" placeholder="URL dokumen" class="input input-bordered w-full" />
                    <input type="file" name="dokumen_file" accept=".pdf,.doc,.docx,.txt" class="file-input file-input-bordered w-full mt-2" />
                    @error('dokumen')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    @error('dokumen_file')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Tags</span></label>
                    <details class="collapse collapse-arrow border border-base-300 bg-base-200">
                        <summary class="collapse-title text-sm font-medium">Pilih tag</summary>
                        <div class="collapse-content space-y-2 pt-2">
                            @php
                                $selectedTags = old('tags', $berita->tags->pluck('id')->toArray());
                            @endphp
                            @forelse($tags as $tag)
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }} class="checkbox checkbox-sm" />
                                    <span class="text-sm">{{ $tag->tagline }}</span>
                                </label>
                            @empty
                                <p class="text-sm text-base-content/60">Belum ada tag. Tambahkan tag terlebih dahulu.</p>
                            @endforelse
                        </div>
                    </details>
                    @error('tags')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    @error('tags.*')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-3">
                        <input type="checkbox" name="published" value="1" {{ old('published', $berita->published) ? 'checked' : '' }} class="checkbox" />
                        <span class="label-text">Terbitkan sekarang</span>
                    </label>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.publikasi.berita.show', $berita) }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function slugify(value) {
        return value.toString().toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    const titleInput = document.querySelector('input[name="judul"]');
    const slugPreview = document.getElementById('slug-preview');

    if (titleInput && slugPreview) {
        titleInput.addEventListener('input', function () {
            const value = slugify(this.value);
            slugPreview.textContent = value || 'Slug akan muncul di sini setelah mengisi judul.';
        });
    }
</script>
@endpush
