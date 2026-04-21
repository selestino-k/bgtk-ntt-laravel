@extends('admin.layouts.app')

@section('title', 'Edit Slide')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Manajemen: Slideshow</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Edit Slide</h1>
        </div>
        <a href="{{ route('admin.slideshow.index') }}" class="btn btn-outline gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="hidden sm:inline">Kembali</span>
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-error mb-6">
            <i class="fa-solid fa-circle-exclamation"></i>
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card border border-base-300 shadow-sm bg-base-100">
        <div class="card-body">
            <form action="{{ route('admin.slideshow.update', $slideshow) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- Gambar --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Gambar</span></label>

                    {{-- Current image --}}
                    @if($slideshow->gambar_url)
                        <div class="mb-3">
                            <p class="text-xs text-base-content/50 mb-1">Gambar saat ini:</p>
                            <img src="{{ $slideshow->gambar_url }}"
                                 alt="{{ $slideshow->judul ?? 'Slide' }}"
                                 class="h-48 rounded-lg object-cover border border-base-300">
                        </div>
                    @endif

                    <input type="file" name="gambar" accept="image/jpg,image/jpeg,image/png,image/webp"
                           class="file-input file-input-bordered w-full"
                           onchange="previewImage(this)" />
                    <p class="text-xs text-base-content/50 mt-1">Kosongkan jika tidak ingin mengganti gambar. Format: jpg, jpeg, png, webp — maks 2MB.</p>
                    @error('gambar')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror

                    {{-- New image preview --}}
                    <div id="image-preview-wrapper" class="mt-3 hidden">
                        <p class="text-xs text-base-content/50 mb-1">Pratinjau gambar baru:</p>
                        <img id="image-preview" src="#" alt="Preview"
                             class="h-48 rounded-lg object-cover border border-base-300">
                    </div>
                </div>

                {{-- Judul --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Judul <span class="text-base-content/50 text-xs">(opsional)</span></span></label>
                    <input type="text" name="judul" value="{{ old('judul', $slideshow->judul) }}"
                           class="input input-bordered w-full" placeholder="Judul slide" />
                    @error('judul')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Deskripsi / Caption <span class="text-base-content/50 text-xs">(opsional)</span></span></label>
                    <textarea name="deskripsi" rows="3"
                              class="textarea textarea-bordered w-full"
                              placeholder="Teks caption yang tampil di bawah slide">{{ old('deskripsi', $slideshow->deskripsi) }}</textarea>
                    @error('deskripsi')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Urutan & Status --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-control">
                        <label class="label"><span class="label-text font-medium">Urutan</span></label>
                        <input type="number" name="urutan" value="{{ old('urutan', $slideshow->urutan) }}" min="0"
                               class="input input-bordered w-full" />
                        <p class="text-xs text-base-content/50 mt-1">Angka lebih kecil tampil lebih dulu.</p>
                        @error('urutan')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-medium">Status</span></label>
                        <label class="flex items-center gap-3 mt-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $slideshow->is_active) ? 'checked' : '' }}
                                   class="checkbox checkbox-success" />
                            <span class="label-text">Aktifkan slide ini</span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.slideshow.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    function previewImage(input) {
        const wrapper = document.getElementById('image-preview-wrapper');
        const preview = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                wrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            wrapper.classList.add('hidden');
        }
    }
</script>
@endpush
