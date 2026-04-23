@extends('admin.layouts.app')

@section('title', 'Tambah Tag')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    <div class="mb-6 flex items-center justify-between gap-4">
        <div>
            <p class="text-sm text-base-content/60">Publikasi: Berita Terkini</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Tambah Tag</h1>
        </div>
        <a href="{{ route('admin.publikasi.tag.index') }}" class="btn btn-outline">Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="card border border-base-300 shadow-sm bg-base-100 max-w-xl">
        <div class="card-body">
            <form action="{{ route('admin.publikasi.tag.store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-control">
                    <label class="label"><span class="label-text">Tagline</span></label>
                    <input type="text" name="tagline" value="{{ old('tagline') }}" required class="input input-bordered w-full" />
                    @error('tagline')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.publikasi.tag.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
