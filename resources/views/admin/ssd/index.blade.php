@extends('admin.layouts.app')

@section('title', 'SSD - Soal Sering Ditanya')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Konten</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Soal Sering Ditanya</h1>
        </div>
        <a href="{{ route('admin.ssd.create') }}" class="btn btn-primary gap-2">
            <i class="fa-solid fa-plus"></i>
            <span class="hidden sm:inline">Tambah Pertanyaan</span>
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

    @if($pertanyaans->isEmpty())
        <div class="card border border-base-300 bg-base-100">
            <div class="card-body items-center text-center py-12">
                <i class="fa-solid fa-circle-question text-4xl text-base-content/30 mb-3"></i>
                <p class="text-base-content/60">Belum ada pertanyaan. Tambahkan pertanyaan baru sekarang.</p>
                <a href="{{ route('admin.ssd.create') }}" class="btn btn-primary mt-4 gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Pertanyaan
                </a>
            </div>
        </div>
    @else
        <div class="card border border-base-300 shadow-sm bg-base-100 overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th class="w-12 text-center">Urutan</th>
                        <th>Pertanyaan</th>
                        <th class="w-24 text-center">Status</th>
                        <th class="w-32 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pertanyaans as $item)
                        <tr>
                            <td class="text-center font-semibold text-primary text-lg">{{ $item->urutan }}</td>
                            <td>
                                <p class="font-semibold">{{ $item->pertanyaan }}</p>
                                <p class="text-sm text-base-content/60 line-clamp-2 mt-0.5">{{ $item->jawaban }}</p>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $item->is_active ? 'badge-success' : 'badge-ghost' }} badge-sm font-semibold uppercase">
                                    {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.ssd.edit', $item) }}"
                                       class="btn btn-sm btn-outline gap-1">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <span class="hidden sm:inline">Edit</span>
                                    </a>
                                    <label for="modal-delete-{{ $item->id }}" class="btn btn-sm btn-error gap-1">
                                        <i class="fa-solid fa-trash"></i>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Delete confirmation modals --}}
        @foreach($pertanyaans as $item)
            <input type="checkbox" id="modal-delete-{{ $item->id }}" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                    <p class="py-4">Hapus pertanyaan <strong>"{{ $item->pertanyaan }}"</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-action">
                        <label for="modal-delete-{{ $item->id }}" class="btn btn-ghost">Batal</label>
                        <form method="POST" action="{{ route('admin.ssd.destroy', $item) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Hapus</button>
                        </form>
                    </div>
                </div>
                <label class="modal-backdrop" for="modal-delete-{{ $item->id }}"></label>
            </div>
        @endforeach
    @endif

</div>
@endsection
