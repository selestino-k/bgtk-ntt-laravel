@extends('admin.layouts.app')

@section('title', 'Kelola Profil')

@section('content')
    <div class="p-6 md:p-8 font-montserrat">
        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl sm:text-4xl font-bold text-primary">Kelola Profil</h1>
            </div>
            <a href="{{ route($routePrefix . '.profil.create') }}" class="btn btn-primary gap-2">
                <i class="fa-solid fa-plus"></i>
                <span class="hidden sm:inline">Buat Profil</span>
            </a>
        </div>

        @if (session('status'))
            <div class="alert alert-success mb-6">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error mb-6">
                <i class="fa-solid fa-circle-xmark"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if ($profiles->isEmpty())
            <div class="card border border-base-300 bg-base-100">
                <div class="card-body items-center text-center">
                    <p class="text-base-content/60">Belum ada profile. Klik "Buat Profil" untuk menambahkan data baru.</p>
                </div>
            </div>
        @else
            <div class="card border border-base-300 shadow-sm bg-base-100">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Sub Judul</th>
                                <th>Gambar</th>
                                <th>Isi Konten</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profiles as $profile)
                                <tr>
                                    <td>{{ $profile->judul }}</td>
                                    <td>{{ $profile->sub_judul }}</td>
                                    <td>
                                        @if ($profile->gambar)
                                            <img src="{{ asset('storage/' . $profile->gambar) }}" alt="Gambar Profil"
                                                class="w-24 h-24 object-cover rounded">
                                        @else
                                            Tidak ada Gambar
                                        @endif
                                    </td>
                                    <td>{{ Str::limit(strip_tags($profile->isi_konten), 100) }}</td>
                                    <td>
                                        <div class="flex gap-2">
                                            <a href="{{ route($routePrefix . '.profil.edit', $profile) }}"
                                                class="btn btn-sm btn-outline dark:outline-taupe-50">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                                Edit
                                            </a>
                                            <label for="modal-delete-{{ $profile->id }}" class="btn btn-sm btn-error">
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

            <div class="mt-6">
                {{ $profiles->links() }}
            </div>

            {{-- Delete confirmation modals --}}
            @foreach ($profiles as $profile)
                <input type="checkbox" id="modal-delete-{{ $profile->id }}" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box">
                        <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                        <p class="py-4">Hapus profil <strong>{{ $profile->judul }}</strong>? Tindakan ini tidak dapat
                            dibatalkan.</p>
                        <div class="modal-action">
                            <label for="modal-delete-{{ $profile->id }}" class="btn">Batal</label>
                            <form action="{{ route($routePrefix . '.profil.destroy', $profile->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error">Hapus</button>
                            </form>
                        </div>
                    </div>
                    <label class="modal-backdrop" for="modal-delete-{{ $profile->id }}"></label>
                </div>
            @endforeach
        @endif
    </div>
@endsection
