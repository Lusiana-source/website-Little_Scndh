<form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium mb-1">Kata Sandi Saat Ini</label>
        <input type="password" name="current_password" required
            class="w-full border-gray-300 rounded px-4 py-2 shadow-sm focus:ring focus:ring-blue-200">
        @error('current_password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium mb-1">Kata Sandi Baru</label>
        <input type="password" name="password" required
            class="w-full border-gray-300 rounded px-4 py-2 shadow-sm focus:ring focus:ring-blue-200">
        @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium mb-1">Konfirmasi Kata Sandi Baru</label>
        <input type="password" name="password_confirmation" required
            class="w-full border-gray-300 rounded px-4 py-2 shadow-sm focus:ring focus:ring-blue-200">
    </div>

    <button type="submit"
        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
        Ubah Kata Sandi
    </button>
</form>
