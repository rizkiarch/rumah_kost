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
                    <form action="{{ route('kost.update', $kost->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="kode"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode</label>
                            <input type="text" autocomplete="off" name="kode" id="kode"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300 "
                                value="{{ $kost->kode }}">
                        </div>
                        <div class="mb-4">
                            <label for="nama_kost"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                Kost</label>
                            <input type="text" autocomplete="off" name="nama_kost" id="nama_kost"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $kost->nama_kost }}">
                        </div>
                        <div class="mb-4">
                            <label for="nominal"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga Kost</label>
                            <input type="number" autocomplete="off" name="nominal" id="nominal"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $kost->nominal }}">
                        </div>
                        <div class="mb-4">
                            <label for="keterangan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Keterangan</label>
                            <input type="text" autocomplete="off" name="keterangan" id="keterangan"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $kost->keterangan }}">
                        </div>
                        <!-- Grid layout untuk buttons -->
                        <div class="grid
                                grid-cols-2 gap-4">
                            <div>
                                <!-- Button "Back" di pojok kiri bawah -->
                                <a href="{{ route('kost.index') }}"
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
</x-app-layout>

<script></script>
