@extends('admin.layouts.app')

@section('title', 'Daftar Tag')

@section('content')
    <div class="p-6 md:p-8 font-montserrat">

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-primary">Daftar Tag</h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.publikasi.tag.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Tag
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success mb-6">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error mb-6">
                <span>{{ session('error') }}</span>
            </div>
        @endif


            @if ($tags->isEmpty())
                <div class="alert">
                    <span>Belum ada tag. Tambahkan tag baru dengan tombol di atas.</span>
                </div>
            @else
                <div class="card border border-base-300 shadow-sm bg-base-100">
                    <div class="card-body p-0">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tagline</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>{{ $tag->id }}</td>
                                            <td>{{ $tag->tagline }}</td>
                                            <td>{{ $tag->created_at->format('d M Y') }}</td>
                                            <td>
                                                <div class="flex flex-wrap gap-2">
                                                    <a href="{{ route('admin.publikasi.tag.edit', $tag) }}"
                                                        class="btn btn-sm btn-outline">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                        Edit
                                                    </a>
                                                    <label for="modal-delete-{{ $tag->id }}" class="btn btn-sm btn-error">
                                                        <i class="fa-solid fa-trash"></i>
                                                        Hapus
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        {{-- Delete confirmation modals --}}
        @foreach ($tags as $tag)
            <input type="checkbox" id="modal-delete-{{ $tag->id }}" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                    <p class="py-4">Hapus tag <strong>{{ $tag->tagline }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-action">
                        <label for="modal-delete-{{ $tag->id }}" class="btn">Batal</label>
                        <form action="{{ route('admin.publikasi.tag.destroy', $tag) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Hapus</button>
                        </form>
                    </div>
                </div>
                <label class="modal-backdrop" for="modal-delete-{{ $tag->id }}"></label>
            </div>
        @endforeach

    </div>
@endsection
