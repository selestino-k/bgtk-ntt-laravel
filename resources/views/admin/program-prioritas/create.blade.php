@extends('admin.layouts.app')

@section('title', 'Tambah Program Prioritas')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Manajemen: Program Prioritas</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Tambah Program Prioritas</h1>
        </div>
        <a href="{{ route('admin.program-prioritas.index') }}" class="btn btn-outline gap-2">
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
            <form action="{{ route('admin.program-prioritas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf

                {{-- Nama Program --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Nama Program <span class="text-error">*</span></span></label>
                    <input type="text" name="nama_program" value="{{ old('nama_program') }}"
                           class="input input-bordered w-full" placeholder="Nama program prioritas" required />
                    @error('nama_program')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- URL --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">URL <span class="text-error">*</span></span></label>
                    <input type="url" name="url" value="{{ old('url') }}"
                           class="input input-bordered w-full" placeholder="https://contoh.com/program" required />
                    @error('url')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                {{-- Gambar --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Gambar</span></label>
                    <input type="file" name="gambar" accept="image/jpg,image/jpeg,image/png,image/webp"
                           class="file-input file-input-bordered w-full"
                           onchange="previewImage(this)" />
                    <p class="text-xs text-base-content/50 mt-1">Format: jpg, jpeg, png, webp — maks 2MB.</p>
                    @error('gambar')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror

                    <div id="image-preview-wrapper" class="mt-3 hidden">
                        <img id="image-preview" src="#" alt="Preview"
                             class="h-48 rounded-lg object-cover border border-base-300">
                    </div>
                </div>

                {{-- Status --}}
                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Status</span></label>
                    <label class="flex items-center gap-3 mt-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               {{ old('is_active', '1') ? 'checked' : '' }}
                               class="checkbox checkbox-success" />
                        <span class="label-text">Aktifkan program ini</span>
                    </label>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="btn btn-primary gap-2">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
                    </button>
                    <a href="{{ route('admin.program-prioritas.index') }}" class="btn btn-outline">Batal</a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script nonce="{{ $cspNonce }}">
    function previewImage(input) {
        const wrapper = document.getElementById('image-preview-wrapper');
        const preview = document.getElementById('image-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
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
