@extends('admin.layouts.app')

@section('title', 'Edit Link')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Manajemen: Links</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Edit Link</h1>
        </div>
        <a href="{{ route('admin.links.index') }}" class="btn btn-outline gap-2">
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
            <form action="{{ route('admin.links.update', $link) }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- Nama --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Nama <span class="text-error">*</span></span></label>
                    <input type="text" name="nama" value="{{ old('nama', $link->nama) }}"
                           class="input input-bordered w-full" placeholder="Nama link" required />
                    @error('nama')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- URL --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">URL <span class="text-error">*</span></span></label>
                    <input type="url" name="url" value="{{ old('url', $link->url) }}"
                           class="input input-bordered w-full" placeholder="https://contoh.com" required />
                    @error('url')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Status --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Status</span></label>
                    <label class="flex items-center gap-3 mt-1 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', $link->is_active) ? 'checked' : '' }}
                               class="checkbox checkbox-success" />
                        <span class="label-text">Aktifkan link ini</span>
                    </label>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Perbarui
                    </button>
                    <a href="{{ route('admin.links.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
