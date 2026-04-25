@extends('admin.layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            {{-- current role --}}
            <p class="text-sm text-base-content/60">Role: {{ ucfirst(auth()->user()->role) }}</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Manajemen Pengguna</h1>
        </div>
        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary gap-2">
                <i class="fa-solid fa-plus"></i>
                <span class="hidden sm:inline">Tambah Pengguna</span>
            </a>
        @endif
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

    <div class="card border border-base-300 shadow-sm bg-base-100">
        <div class="card-body p-0 overflow-x-auto">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Dibuat</th>
                        @if(auth()->user()->role === 'admin')
                            <th class="text-right">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td class="font-medium">{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role === 'admin' ? 'badge-primary' : 'badge-ghost' }} badge-sm font-semibold uppercase">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="text-sm text-base-content/60">{{ $user->created_at->format('d M Y') }}</td>
                            @if(auth()->user()->role === 'admin')
                                <td class="text-right">
                                    <div class="flex justify-end gap-2">
                                        <a href="{{ route('admin.user.edit', $user) }}" class="btn btn-sm btn-outline gap-1">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                            <span class="hidden sm:inline">Edit</span>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <label for="modal-delete-{{ $user->id }}" class="btn btn-sm btn-error gap-1">
                                                <i class="fa-solid fa-trash"></i>
                                                <span class="hidden sm:inline">Hapus</span>
                                            </label>
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->role === 'admin' ? 6 : 5 }}" class="text-center text-base-content/60 py-8">
                                Belum ada pengguna terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $users->links() }}
    </div>

    {{-- Delete confirmation modals --}}
    @foreach($users as $user)
        @if($user->id !== auth()->id())
            <input type="checkbox" id="modal-delete-{{ $user->id }}" class="modal-toggle" />
            <div class="modal">
                <div class="modal-box">
                    <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                    <p class="py-4">Hapus pengguna <strong>{{ $user->username }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    <div class="modal-action">
                        <label for="modal-delete-{{ $user->id }}" class="btn">Batal</label>
                        <form action="{{ route('admin.user.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error">Hapus</button>
                        </form>
                    </div>
                </div>
                <label class="modal-backdrop" for="modal-delete-{{ $user->id }}"></label>
            </div>
        @endif
    @endforeach

</div>
@endsection
