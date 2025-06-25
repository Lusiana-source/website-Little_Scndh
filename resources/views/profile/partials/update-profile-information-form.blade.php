<form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('PUT')

    <div>
        <label class="block font-medium mb-1">Nama</label>
        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
            class="w-full border-gray-300 rounded px-4 py-2 shadow-sm focus:ring focus:ring-blue-200">
        @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block font-medium mb-1">Email</label>
        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
            class="w-full border-gray-300 rounded px-4 py-2 shadow-sm focus:ring focus:ring-blue-200">
        @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
        Simpan Perubahan
    </button>
</form>
