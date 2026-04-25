@extends('admin.layouts.app')

@section('title', 'Ubah Profil')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Role: {{ ucfirst($routePrefix) }}</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Ubah Profil</h1>
        </div>
        <a href="{{ route($routePrefix . '.profil.index') }}" class="btn btn-outline gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="hidden sm:inline">Kembali</span>
        </a>
    </div>

    <div class="card border border-base-300 shadow-sm bg-base-100">
        <div class="card-body">
            <form action="{{ route($routePrefix . '.profil.update', $profile) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PATCH')

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Judul</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $profile->judul) }}" required class="input input-bordered w-full" />
                    @error('judul')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Sub Judul</span></label>
                    <input type="text" name="sub_judul" value="{{ old('sub_judul', $profile->sub_judul) }}" class="input input-bordered w-full" />
                    @error('sub_judul')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Isi Konten</span></label>
                    <textarea name="isi_konten" rows="6" required class="textarea textarea-bordered w-full">{{ old('isi_konten', $profile->isi_konten) }}</textarea>
                    @error('isi_konten')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Gambar (URL, nama file, atau upload)</span></label>
                    <input type="text" name="gambar" value="{{ old('gambar', $profile->gambar) }}" placeholder="URL atau nama file" class="input input-bordered w-full" />
                    <input type="file" name="gambar_file" accept="image/*" class="file-input file-input-bordered w-full mt-2" id="gambar_file_input" />
                    <p id="gambar_file_size_error" class="mt-1 text-sm text-error hidden">Ukuran gambar tidak boleh melebihi 2MB.</p>
                    @error('gambar')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    @error('gambar_file')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route($routePrefix . '.profil.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>

@push('scripts')
<script>
    document.getElementById('gambar_file_input').addEventListener('change', function () {
        const maxSize = 2 * 1024 * 1024; // 2MB
        const errorEl = document.getElementById('gambar_file_size_error');
        if (this.files[0] && this.files[0].size > maxSize) {
            errorEl.classList.remove('hidden');
            this.value = '';
        } else {
            errorEl.classList.add('hidden');
        }
    });
</script>
@endpush
@endsection
