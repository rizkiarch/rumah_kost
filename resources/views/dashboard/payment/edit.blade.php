<style>
    input[type="date"] {
        position: relative;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: auto;
        height: auto;
        color: transparent;
        background: transparent;
        */you need to disable the background becasue the icon can repeat based on input size */
    }

    input[type="datetime-local"] {
        position: relative;
    }

    input[type="datetime-local"]::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        width: auto;
        height: auto;
        color: transparent;
        background: transparent;
        */you need to disable the background becasue the icon can repeat based on input size */
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance: textfield;
        /* Firefox */
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('payment.update', $payment->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="kontak_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                Lengkap</label>
                            <select name="kontak_id" id="kontak_id" required
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                @foreach ($kontaks as $kontak)
                                    <option value="{{ $kontak->id }}"
                                        @if ($payment->kontak_id == $kontak->id) selected @endif>
                                        {{ $kontak->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="mb-4">
                            <label for="no_telpon"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telpon</label>
                            <input type="number" autocomplete="off" name="no_telpon" id="no_telpon"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                        </div> --}}
                        <div class="mb-4">
                            <label for="tanggal_pembayaran"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                                Pembayaran</label>
                            <input readonly type="date" autocomplete="off" name="tanggal_pembayaran"
                                id="tanggal_pembayaran" value="{{ $payment->tanggal_masuk ?? date('Y-m-d') }}"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <div class="mb-4">
                            <label for="nominal"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nominal
                                Pembayaran</label>
                            <input type="text" autocomplete="off" name="nominal" id="nominal"
                                onkeyup="formatRupiah(this)" value="{{ $payment->nominal ?? '' }}"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <!-- Grid layout untuk buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <!-- Button " Back" di pojok kiri bawah -->
                                <a href="{{ route('laporan.index') }}"
                                    class="mt-4 bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">Back</a>
                            </div>
                            <div class="text-right">
                                <!-- Button "Simpan" di pojok kanan bawah -->
                                <button type="reset"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg text-sm">Reset</button>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        document.getElementById('nama_lengkap').addEventListener('change', function() {
            const selectedId = this.value;
            const phoneInput = document.getElementById('no_telpon');

            // Assuming you have a way to fetch contact data by ID (replace with your actual logic)
            fetch(`/api/kontak/${selectedId}`)
                .then(response => response.json())
                .then(data => {
                    if (Array.isArray(data.data)) {
                        const phoneNumbers = data.data.map(contact => contact.no_telpon);
                        console.log(phoneNumbers);
                        phoneInput.value = phoneNumbers[0]; // Access the first phone number
                    } else {
                        console.error('Unexpected data format. Please check API response.');
                        // Handle non-array data appropriately
                    }
                })
                .catch(error => {
                    console.error('Error fetching contact data:', error);
                    // Handle errors appropriately (e.g., display an error message to the user)
                    alert('Failed to retrieve contact information. Please try again later.');
                });
        });
    </script> --}}
</x-app-layout>
