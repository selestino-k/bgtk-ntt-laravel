@extends('admin.layouts.app')

@section('title', 'Program Prioritas')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Manajemen</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Program Prioritas</h1>
        </div>
        <a href="{{ route('admin.program-prioritas.create') }}" class="btn btn-primary gap-2">
            <i class="fa-solid fa-plus"></i>
            <span class="hidden sm:inline">Tambah Program</span>
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-6">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error mb-6">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @if($programPrioritas->isEmpty())
        <div class="card border border-base-300 bg-base-100">
            <div class="card-body items-center text-center py-12">
                <i class="fa-solid fa-list-check text-4xl text-base-content/30 mb-3"></i>
                <p class="text-base-content/60">Belum ada program prioritas. Tambahkan sekarang.</p>
                <a href="{{ route('admin.program-prioritas.create') }}" class="btn btn-primary mt-4 gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Program
                </a>
            </div>
        </div>
    @else
        <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
            @foreach($programPrioritas as $program)
                <div class="card border border-base-300 shadow-sm bg-base-100 transition hover:-translate-y-1">
                    {{-- Thumbnail --}}
                    @if($program->gambar_url)
                        <figure class="h-28 bg-base-200 flex items-center justify-center rounded-t-2xl p-4">
                            <img src="{{ $program->gambar_url }}"
                                 alt="{{ $program->nama_program }}"
                                 class="w-full h-full object-contain">
                        </figure>
                    @else
                        <div class="h-28 bg-base-200 flex items-center justify-center rounded-t-2xl">
                            <i class="fa-solid fa-image text-3xl text-base-content/30"></i>
                        </div>
                    @endif

                    <div class="card-body p-5">
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <span class="badge {{ $program->is_active ? 'badge-success' : 'badge-ghost' }} badge-sm font-semibold uppercase">
                                {{ $program->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>

                        <h2 class="card-title text-base">{{ $program->nama_program }}</h2>
                        <a href="{{ $program->url }}" target="_blank" rel="noopener noreferrer"
                           class="text-xs text-primary truncate hover:underline">{{ $program->url }}</a>

                        <div class="card-actions justify-end mt-4 gap-2">
                            <a href="{{ route('admin.program-prioritas.edit', $program) }}"
                               class="btn btn-sm btn-outline gap-1">
                                <i class="fa-solid fa-pen-to-square"></i>
                                <span class="hidden sm:inline">Edit</span>
                            </a>
                            <label for="modal-delete-{{ $program->id }}" class="btn btn-sm btn-error gap-1">
                                <i class="fa-solid fa-trash"></i>
                                <span class="hidden sm:inline">Hapus</span>
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Delete confirmation modals --}}
        @foreach($programPrioritas as $program)
            <input type="checkbox" id="modal-delete-{{ $program->id }}" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                    <p class="py-4">Hapus program <strong>{{ $program->nama_program }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-action">
                        <label for="modal-delete-{{ $program->id }}" class="btn">Batal</label>
                        <form action="{{ route('admin.program-prioritas.destroy', $program) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Hapus</button>
                        </form>
                    </div>
                </div>
                <label class="modal-backdrop" for="modal-delete-{{ $program->id }}"></label>
            </div>
        @endforeach
    @endif

</div>
@endsection
