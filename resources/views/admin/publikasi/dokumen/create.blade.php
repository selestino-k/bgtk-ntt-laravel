@extends('admin.layouts.app')

@section('title', 'Tambah Dokumen')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Publikasi: Dokumen</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Tambah Dokumen</h1>
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
            <form action="{{ route('admin.publikasi.dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Judul</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="input input-bordered w-full" />
                    @error('judul')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Deskripsi</span></label>
                    <textarea name="deskripsi" rows="5" class="textarea textarea-bordered w-full">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Tautan File (Jika menggunakan tautan)</span></label>
                    <input type="text" name="file_url" value="{{ old('file_url') }}" placeholder="https://example.com/file.pdf atau /storage/dokumen/file.pdf" class="input input-bordered w-full" />
                    @error('file_url')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Upload File</span></label>
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.txt" class="file-input file-input-bordered w-full" />
                    @error('file')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Kategori</span></label>
                    <select name="kategori" class="select select-bordered w-full">
                        <option value="">Pilih Kategori</option>

                        <optgroup label="Dokumen Umum">
                            <option value="Perjanjian Kinerja" {{ old('kategori') == 'Perjanjian Kinerja' ? 'selected' : '' }}>Perjanjian Kinerja</option>
                            <option value="Laporan Kinerja" {{ old('kategori') == 'Laporan Kinerja' ? 'selected' : '' }}>Laporan Kinerja</option>
                            <option value="Rencana Strategis" {{ old('kategori') == 'Rencana Strategis' ? 'selected' : '' }}>Rencana Strategis</option>
                            <option value="Maklumat Pelayanan" {{ old('kategori') == 'Maklumat Pelayanan' ? 'selected' : '' }}>Maklumat Pelayanan</option>
                        </optgroup>

                        <optgroup label="ZI-WBK">
                            <option value="Manajemen Perubahan" {{ old('kategori') == 'Manajemen Perubahan' ? 'selected' : '' }}>Manajemen Perubahan</option>
                            <option value="Penataan Tata Laksana" {{ old('kategori') == 'Penataan Tata Laksana' ? 'selected' : '' }}>Penataan Tata Laksana</option>
                            <option value="Penataan Sistem Manajemen SDM" {{ old('kategori') == 'Penataan Sistem Manajemen SDM' ? 'selected' : '' }}>Penataan Sistem Manajemen SDM</option>
                            <option value="Penguatan Akuntabilitas" {{ old('kategori') == 'Penguatan Akuntabilitas' ? 'selected' : '' }}>Penguatan Akuntabilitas</option>
                            <option value="Penguatan Pengawasan" {{ old('kategori') == 'Penguatan Pengawasan' ? 'selected' : '' }}>Penguatan Pengawasan</option>
                            <option value="Penguatan Kualitas Pelayanan Publik" {{ old('kategori') == 'Penguatan Kualitas Pelayanan Publik' ? 'selected' : '' }}>Penguatan Kualitas Pelayanan Publik</option>
                        </optgroup>

                        <optgroup label="Lainnya">
                            <option value="Penghargaan" {{ old('kategori') == 'Penghargaan' ? 'selected' : '' }}>Penghargaan</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </optgroup>
                    </select>
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
