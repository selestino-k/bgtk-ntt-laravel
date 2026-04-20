@extends('admin.layouts.app')

@section('title', 'Kelola Profil')

@section('content')
<div class="p-6 md:p-8 font-montserrat">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Role: {{ ucfirst($routePrefix) }}</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Kelola Profil</h1>
        </div>
        <a href="{{ route($routePrefix . '.profiles.create') }}" class="btn btn-primary gap-2">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profiles as $profile)
                            <tr>
                                <td>{{ $profile->judul }}</td>
                                <td>{{ $profile->sub_judul }}</td>
                                <td>{{ $profile->gambar ?: '-' }}</td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route($routePrefix . '.profiles.edit', $profile) }}" class="btn btn-sm btn-outline">Edit</a>
                                        <form action="{{ route($routePrefix . '.profiles.destroy', $profile->id) }}" method="POST" onsubmit="return confirm('Hapus profil ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Hapus</button>
                                        </form>
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
    @endif
</div>
@endsection
