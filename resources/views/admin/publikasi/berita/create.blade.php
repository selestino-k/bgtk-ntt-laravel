@extends('admin.layouts.app')

@section('title', 'Tambah Berita')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Publikasi: Berita Terkini</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Tambah Berita</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline gap-2">
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
            <form action="{{ route('admin.publikasi.berita.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Judul</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="input input-bordered w-full" />
                    @error('judul')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <input type="hidden" name="slug" id="slug" value="{{ old('slug') }}" />
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Slug (otomatis dari judul)</span></label>
                    <p id="slug-preview" class="rounded-lg border border-base-300 bg-base-200 px-4 py-3 text-sm text-base-content/70">
                        {{ old('slug') ?: 'Slug akan muncul di sini setelah mengisi judul.' }}
                    </p>
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Isi Berita</span></label>
                    <textarea name="isi" rows="8" required class="textarea textarea-bordered w-full font-inter">{{ old('isi') }}</textarea>
                    @error('isi')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Gambar (URL atau upload)</span></label>
                    <input type="text" id="gambar-url" name="gambar" value="{{ old('gambar') }}" placeholder="URL gambar" class="input input-bordered w-full" />
                    <input type="file" id="gambar-file" name="gambar_file" accept="image/*" class="file-input file-input-bordered w-full mt-2" />
                    <p class="text-xs text-base-content/50 mt-1">Upload file akan mengutamakan daripada URL. Format: jpg, jpeg, png, webp, gif — maks 2MB.</p>
                    <div id="gambar-preview-wrapper" class="mt-3 hidden">
                        <p class="text-xs text-base-content/50 mb-1">Pratinjau gambar:</p>
                        <img id="gambar-preview" src="" alt="Pratinjau" class="max-h-48 rounded-lg border border-base-300 object-contain" />
                    </div>
                    @error('gambar')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    @error('gambar_file')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Dokumen (URL)</span></label>
                    <input type="text" name="dokumen_url" value="{{ old('dokumen_url') }}" placeholder="Masukkan URL dokumen" class="input input-bordered w-full" />
                    @error('dokumen_url')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Tags</span></label>
                    <details class="collapse collapse-arrow border border-base-300 bg-base-200">
                        <summary class="collapse-title text-sm font-medium">Pilih tag</summary>
                        <div class="collapse-content pt-2">
                            @php
                                $pengumumanTags = $tags->filter(fn($t) => strtolower($t->tagline) === 'pengumuman' || strtolower($t->tagline) === 'Pengumuman');
                                $otherTags = $tags->filter(fn($t) => strtolower($t->tagline) !== 'pengumuman');
                            @endphp
                            @if($tags->isEmpty())
                                <p class="text-sm text-base-content/60">Belum ada tag. Tambahkan tag terlebih dahulu.</p>
                            @else
                                @if($pengumumanTags->isNotEmpty())
                                    <div class="space-y-2">
                                        <p class="text-sm font-medium text-primary">Buat sebagai Pengumuman</p>
                                        @foreach($pengumumanTags as $tag)
                                            <label class="flex items-center gap-3 cursor-pointer">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="checkbox checkbox-primary checkbox-xs" />
                                                <span class="text-sm font-medium">{{ $tag->tagline }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                    @if($otherTags->isNotEmpty())
                                        <div class="divider my-3"></div>
                                    @endif
                                @endif
                                @if($otherTags->isNotEmpty())
                                    <div class="space-y-2">
                                        @foreach($otherTags as $tag)
                                            <label class="flex items-center gap-3 cursor-pointer">
                                                <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="checkbox checkbox-primary checkbox-xs" />
                                                <span class="text-sm">{{ $tag->tagline }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>
                    </details>
                    @error('tags')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    @error('tags.*')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-3">
                        <input type="checkbox" name="published" value="1" {{ old('published') ? 'checked' : '' }} class="checkbox checkbox-success" />
                        <span class="label-text">Terbitkan sekarang</span>
                    </label>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.publikasi.berita.index') }}" class="btn btn-outline">Batal</a>
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
    const slugInput = document.getElementById('slug');
    const slugPreview = document.getElementById('slug-preview');

    if (titleInput && slugInput && slugPreview) {
        titleInput.addEventListener('input', function () {
            const value = slugify(this.value);
            slugInput.value = value;
            slugPreview.textContent = value || 'Slug akan muncul di sini setelah mengisi judul.';
        });
    }

    const gambarUrl = document.getElementById('gambar-url');
    const gambarFile = document.getElementById('gambar-file');
    const gambarPreview = document.getElementById('gambar-preview');
    const gambarPreviewWrapper = document.getElementById('gambar-preview-wrapper');

    function showPreview(src) {
        if (src) {
            gambarPreview.src = src;
            gambarPreviewWrapper.classList.remove('hidden');
        } else {
            gambarPreview.src = '';
            gambarPreviewWrapper.classList.add('hidden');
        }
    }

    if (gambarFile) {
        gambarFile.addEventListener('change', function () {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => showPreview(e.target.result);
                reader.readAsDataURL(this.files[0]);
            } else if (!gambarUrl.value.trim()) {
                showPreview('');
            }
        });
    }

    if (gambarUrl) {
        gambarUrl.addEventListener('input', function () {
            if (!gambarFile.files || !gambarFile.files[0]) {
                showPreview(this.value.trim());
            }
        });
    }

    // Show preview on page load if old URL value exists
    @if(old('gambar'))
    showPreview('{{ old('gambar') }}');
    @endif
</script>
@endpush
