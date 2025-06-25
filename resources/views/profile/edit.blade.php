@extends('layouts.app') {{-- Ganti dengan layout utama kamu jika berbeda --}}

@section('content')
    <div class="max-w-2xl mx-auto py-10 space-y-10">
        <h1 class="text-2xl font-bold mb-6">Profil Saya</h1>

        {{-- Update Profile Information --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Informasi Pengguna</h2>
            @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold mb-4">Ubah Kata Sandi</h2>
            @include('profile.partials.update-password-form')
        </div>

        {{-- Delete User --}}
        <div class="bg-white p-6 rounded shadow border border-red-500">
            <h2 class="text-xl font-semibold text-red-600 mb-4">Hapus Akun</h2>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
@endsection
