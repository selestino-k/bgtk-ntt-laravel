@extends('admin.layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="p-6 md:p-8 font-montserrat">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <p class="text-sm text-base-content/60">Admin: Manajemen Pengguna</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary">Tambah Pengguna</h1>
        </div>
        <a href="{{ route('admin.user.index') }}" class="btn btn-outline gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span class="hidden sm:inline">Kembali</span>
        </a>
    </div>

    <div class="card border border-base-300 shadow-sm bg-base-100 max-w-lg">
        <div class="card-body">
            <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-5">
                @csrf

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Username</span></label>
                    <input type="text" name="username" value="{{ old('username') }}" required
                        class="input input-bordered w-full @error('username') input-error @enderror" />
                    @error('username')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Email</span></label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="input input-bordered w-full @error('email') input-error @enderror" />
                    @error('email')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Role</span></label>
                    <select name="role" required class="select select-bordered w-full @error('role') select-error @enderror">
                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih role</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ old('role') === 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                    @error('role')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Password</span></label>
                    <input type="password" name="password" required
                        class="input input-bordered w-full @error('password') input-error @enderror" />
                    @error('password')<p class="mt-1 text-sm text-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-control">
                    <label class="label"><span class="label-text font-medium">Konfirmasi Password</span></label>
                    <input type="password" name="password_confirmation" required
                        class="input input-bordered w-full" />
                </div>

                <div class="pt-2">
                    <button type="submit" class="btn btn-primary w-full">
                        <i class="fa-solid fa-user-plus mr-2"></i> Simpan Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
