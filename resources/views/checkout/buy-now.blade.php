@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-10">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Checkout - Beli Sekarang</h1>

        <!-- Tabel Produk -->
        <div class="overflow-x-auto mb-6">
            <table class="w-full border border-gray-300 rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-left">
                    <tr>
                        <th class="py-2 px-4">Produk</th>
                        <th class="py-2 px-4">Harga</th>
                        <th class="py-2 px-4">Jumlah</th>
                        <th class="py-2 px-4">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $subtotal = $item['price'] * $item['quantity']; @endphp
                    <tr class="border-t border-gray-200">
                        <td class="py-2 px-4">{{ $item['name'] }}</td>
                        <td class="py-2 px-4">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="py-2 px-4">{{ $item['quantity'] }}</td>
                        <td class="py-2 px-4">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                    <tr class="border-t bg-gray-100 font-semibold text-lg">
                        <td colspan="3" class="py-3 px-4 text-right">Total:</td>
                        <td class="py-3 px-4 text-blue-600">Rp{{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Form Checkout -->
        <form action="{{ route('checkout.buy-now.process') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-medium">Nama</label>
                <input type="text" name="name" required class="w-full border rounded px-4 py-2"
                       value="{{ old('name', Auth::user()->name ?? '') }}">
            </div>
            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" required class="w-full border rounded px-4 py-2"
                       value="{{ old('email', Auth::user()->email ?? '') }}">
            </div>
            <div>
                <label class="block mb-1 font-medium">Telepon</label>
                <input type="text" name="phone" required class="w-full border rounded px-4 py-2"
                       value="{{ old('phone') }}">
            </div>
            <div>
                <label class="block mb-1 font-medium">Alamat</label>
                <textarea name="address" required class="w-full border rounded px-4 py-2">{{ old('address') }}</textarea>
            </div>

            <!-- Metode Pembayaran -->
            <div>
                <label for="payment_method" class="block font-medium mb-1">Metode Pembayaran</label>
                <select name="payment_method" id="payment_method" required
                        class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Pilih Metode --</option>
                    <option value="cod" {{ old('payment_method') == 'cod' ? 'selected' : '' }}>Bayar di Tempat (COD)</option>
                    <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                </select>

                <!-- Info Tambahan Transfer Bank -->
                <div id="bank-info" class="mt-4 hidden">
                    <label class="block font-medium mb-1">Nomor Rekening Tujuan</label>
                    <div class="bg-gray-100 p-3 rounded">
                        <p class="text-sm text-gray-800 font-semibold">Bank BCA - 1234567890 a.n. Little Scndh</p>
                        <p class="text-xs text-gray-500 mt-1">Silakan transfer ke rekening di atas lalu konfirmasi ke admin.</p>
                    </div>
                </div>

                @error('payment_method')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Selesaikan Pembelian
                </button>
            </div>
        </form>

        <!-- Script Toggle Transfer Info -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const paymentSelect = document.getElementById('payment_method');
                const bankInfo = document.getElementById('bank-info');

                function toggleBankInfo() {
                    if (paymentSelect.value === 'transfer') {
                        bankInfo.classList.remove('hidden');
                    } else {
                        bankInfo.classList.add('hidden');
                    }
                }

                toggleBankInfo();
                paymentSelect.addEventListener('change', toggleBankInfo);
            });
        </script>
    </div>
</div>
@endsection
