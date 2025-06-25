@extends('layouts.app')

@section('title', 'Lupa Password')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-xl font-bold text-gray-800 mb-4 text-center">Ubah Kata Sandi</h2>

    {{-- Notifikasi sukses --}}
    @if(session('status') === 'password-updated')
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4 text-sm">
            Kata sandi berhasil diperbarui!
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('PUT')

        {{-- Password Saat Ini --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Saat Ini</label>
            <input type="password" name="current_password" autocomplete="current-password" required
                class="w-full border border-gray-300 rounded px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('current_password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Password Baru --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi Baru</label>
            <input type="password" name="password" autocomplete="new-password" required
                class="w-full border border-gray-300 rounded px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Konfirmasi Password --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="password_confirmation" autocomplete="new-password" required
                class="w-full border border-gray-300 rounded px-4 py-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition duration-300 shadow">
            Simpan Perubahan
        </button>
    </form>
</div>

</div>
@endsection
