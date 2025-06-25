@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-10">
    <h1 class="text-2xl font-bold mb-6 text-center">Profil Saya</h1>

    {{-- Update Informasi Profil --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Informasi Profil</h2>
        @include('profile.partials.update-profile-information-form')
    </div>

    {{-- Update Password --}}
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Ubah Kata Sandi</h2>
        @include('profile.partials.update-password-form')
    </div>

    {{-- Hapus Akun --}}
    <div class="bg-red-50 shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold text-red-600 mb-4">Hapus Akun</h2>
        <p class="text-sm text-gray-600 mb-4">Menghapus akun akan menghapus seluruh data Anda secara permanen.</p>
        @include('profile.partials.delete-user-form')
    </div>
</div>
@endsection
