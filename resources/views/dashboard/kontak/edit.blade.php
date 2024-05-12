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
                    <form action="{{ route('kontak.update', $penghuni->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="nik"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIK</label>
                            <input type="number" autocomplete="off" name="nik" id="nik"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $penghuni->nik }}">
                        </div>
                        <div class="mb-4">
                            <label for="nama_lengkap"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                Lengkap</label>
                            <input type="text" autocomplete="off" name="nama_lengkap" id="nama_lengkap"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $penghuni->nama_lengkap }}">
                        </div>
                        <div class="mb-4">
                            <label for="nama_panggilan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                Panggilan</label>
                            <input type="text" autocomplete="off" name="nama_panggilan" id="nama_panggilan"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $penghuni->nama_panggilan }}">
                        </div>
                        <div class="mb-4">
                            <label for="tempat_lahir"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tempat
                                Lahir</label>
                            <input type="text" autocomplete="off" name="tempat_lahir" id="tempat_lahir"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $penghuni->tempat_lahir }}">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_lahir"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                                Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="form-control mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $penghuni->tanggal_lahir }}">
                        </div>
                        <div class="mb-4">
                            <label for="jenis_kelamin"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                                Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                <option value="L" @if ($penghuni->jenis_kelamin == 'L') selected @endif>Laki-laki
                                </option>
                                <option value="P" @if ($penghuni->jenis_kelamin == 'P') selected @endif>Perempuan
                                </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="agama"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Agama</label>
                            <select name="agama" id="agama"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                <option value="Islam" @if ($penghuni->agama == 'Islam') selected @endif>Islam</option>
                                <option value="Katholik" @if ($penghuni->agama == 'Katholik') selected @endif>Katholik
                                </option>
                                <option value="Kristen" @if ($penghuni->agama == 'Kristen') selected @endif>Kristen
                                </option>
                                <option value="Buddha" @if ($penghuni->agama == 'Buddha') selected @endif>Buddha</option>
                                <option value="Hindu" @if ($penghuni->agama == 'Hindu') selected @endif>Hindu</option>
                                <option value="Khonghucu" @if ($penghuni->agama == 'Khonghucu') selected @endif>Khonghucu
                                </option>
                                <option value="Kepercayaan Terhadap Tuhan YME"
                                    @if ($penghuni->agama == 'Kepercayaan Terhadap Tuhan YME') selected @endif>Kepercayaan Terhadap Tuhan YME
                                </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="status_perkawinan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status
                                Perkawinan</label>
                            <select name="status_perkawinan" id="status_perkawinan"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                <option value="Lajang" @if ($penghuni->status_perkawinan == 'Lajang') selected @endif>Lajang</option>
                                <option value="Menikah" @if ($penghuni->status_perkawinan == 'Menikah') selected @endif>Menikah
                                </option>
                                <option value="Duda/Janda" @if ($penghuni->status_perkawinan == 'Duda/Janda') selected @endif>
                                    Duda/Janda</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="pekerjaan"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pekerjaan</label>
                            <select name="pekerjaan" id="pekerjaan"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                <option value="Tidak Bekerja" @if ($penghuni->pekerjaan == 'Tidak Bekerja') selected @endif>Tidak
                                    Bekerja</option>
                                <option value="Mahasiswa/Pelajar" @if ($penghuni->pekerjaan == 'Mahasiswa/Pelajar') selected @endif>
                                    Mahasiswa/Pelajar</option>
                                <option value="Karyawan Swasta" @if ($penghuni->pekerjaan == 'Karyawan Swasta') selected @endif>
                                    Karyawan Swasta</option>
                                <option value="Wirausaha" @if ($penghuni->pekerjaan == 'Wirausaha') selected @endif>Wirausaha
                                </option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="no_telpon"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telpon</label>
                            <input type="number" autocomplete="off" name="no_telpon" id="no_telpon"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                value="{{ $penghuni->no_telpon }}">
                        </div>
                        <div class="mb-4">
                            <label for="tanggal_masuk"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                                Masuk</label>
                            <input type="datetime-local" autocomplete="off" name="tanggal_masuk" id="tanggal_masuk"
                                value="{{ $penghuni->tanggal_masuk ?? now() }}"
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <!-- Grid layout untuk buttons -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <!-- Button "Back" di pojok kiri bawah -->
                                <a href="{{ route('kontak.index') }}"
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
