@extends('admin.layouts.app')

@section('title', 'Edit Pertanyaan SSD')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Konten: SSD</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Edit Pertanyaan</h1>
        </div>
        <a href="{{ route('admin.ssd.index') }}" class="btn btn-outline gap-2">
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
            <form action="{{ route('admin.ssd.update', $ssd) }}" method="POST" class="space-y-5">
                @csrf
                @method('PATCH')

                {{-- Pertanyaan --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Pertanyaan <span class="text-error">*</span></span></label>
                    <input type="text" name="pertanyaan" value="{{ old('pertanyaan', $ssd->pertanyaan) }}"
                           class="input input-bordered w-full" placeholder="Tuliskan pertanyaan..." required />
                    @error('pertanyaan')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Jawaban --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Jawaban <span class="text-error">*</span></span></label>
                    <textarea name="jawaban" rows="5"
                              class="textarea textarea-bordered w-full"
                              placeholder="Tuliskan jawaban..." required>{{ old('jawaban', $ssd->jawaban) }}</textarea>
                    @error('jawaban')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Urutan & Status --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="form-control">
                        <label class="label"><span class="label-text font-medium">Urutan</span></label>
                        <input type="number" name="urutan" value="{{ old('urutan', $ssd->urutan) }}" min="0"
                               class="input input-bordered w-full" />
                        <p class="text-xs text-base-content/50 mt-1">Angka lebih kecil tampil lebih dulu.</p>
                        @error('urutan')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label"><span class="label-text font-medium">Status</span></label>
                        <label class="flex items-center gap-3 mt-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $ssd->is_active) ? 'checked' : '' }}
                                   class="checkbox checkbox-success" />
                            <span class="label-text">Aktifkan pertanyaan ini</span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.ssd.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
