<form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
    @csrf
    @method('DELETE')

    <button type="submit"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">
        Hapus Akun Saya
    </button>
</form>
