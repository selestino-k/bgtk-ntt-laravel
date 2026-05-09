@extends('admin.layouts.app')

@section('title', 'Edit Dokumen')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Publikasi: Dokumen</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Edit Dokumen</h1>
        </div>
        <a href="{{ route('admin.publikasi.dokumen.index') }}" class="btn btn-outline gap-2">
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
            <form action="{{ route('admin.publikasi.dokumen.update', $dokumen) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PATCH')

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Judul</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $dokumen->judul) }}" required class="input input-bordered w-full" />
                    @error('judul')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Deskripsi</span></label>
                    <textarea name="deskripsi" rows="5" class="textarea textarea-bordered w-full">{{ old('deskripsi', $dokumen->deskripsi) }}</textarea>
                    @error('deskripsi')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Tautan File</span></label>
                    <input type="text" name="file_url" value="{{ old('file_url', $dokumen->file_url) }}" placeholder="https://example.com/file.pdf atau /storage/dokumen/file.pdf" class="input input-bordered w-full" />
                    @error('file_url')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Upload File Baru</span></label>
                    <p class="text-sm text-base-content/60 mb-1">File saat ini: {{ $dokumen->file_name }}</p>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.txt" class="file-input file-input-bordered w-full" />
                    @error('file')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Kategori</span></label>
                    <input type="text" name="kategori" value="{{ old('kategori', $dokumen->kategori) }}" class="input input-bordered w-full" />
                    @error('kategori')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.publikasi.dokumen.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
