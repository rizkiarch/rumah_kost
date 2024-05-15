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
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">Daftar Laporan Pesan Terkirim</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nama</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nomor Telepon</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal Terkirim</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col" class="relative px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                                @if ($laporans->isEmpty())
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 text-center">
                                            Tidak ada data </td>
                                    </tr>
                                @else
                                    @foreach ($laporans as $laporan)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 capitalize">
                                                {{ $laporan->jadwal->kontak->nama_lengkap }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $laporan->jadwal->kontak->no_telpon }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $laporan->tanggal_terkirim }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $laporan->status }}
                                            </td>
                                            @if ($laporan->status == 'pending')
                                                <form action="{{ route('laporan.update', $laporan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        {{-- <input type="text" name="tanggal_terkirim" class="hidden"
                                                            value="{{ date('Y-m-d') }}"> --}}
                                                        <button type="submit"
                                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">kirim
                                                            ulang</button>
                                                    </td>
                                                </form>
                                                {{-- @else
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('laporan.edit', $laporan->id) }}"
                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-700">Edit</a>
                                                    <form action="{{ route('laporan.destroy', $laporan->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-700 ml-2">Hapus</button>
                                                    </form>
                                                </td> --}}
                                            @endif

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between mb-6">
                        <h3 class="text-lg font-semibold">Daftar Laporan Pembayaran</h3>
                        <a href="{{ route('payment.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nama</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nomor Telepon</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal Pembayaran</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Nominal</th>
                                    <th scope="col" class="relative px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                                @if ($laporans->isEmpty())
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 text-center">
                                            Tidak ada data </td>
                                    </tr>
                                @else
                                    @foreach ($laporans as $laporan)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 capitalize">
                                                {{ $laporan->jadwal->kontak->nama_lengkap }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $laporan->jadwal->kontak->no_telpon }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $laporan->tanggal_terkirim }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $laporan->status }}
                                            </td>
                                            @if ($laporan->status == 'pending')
                                                <form action="{{ route('laporan.update', $laporan->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <td
                                                        class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                        {{-- <input type="text" name="tanggal_terkirim" class="hidden"
                                                            value="{{ date('Y-m-d') }}"> --}}
                                                        <button type="submit"
                                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">kirim
                                                            ulang</button>
                                                    </td>
                                                </form>
                                                {{-- @else
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('laporan.edit', $laporan->id) }}"
                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-700">Edit</a>
                                                    <form action="{{ route('laporan.destroy', $laporan->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-700 ml-2">Hapus</button>
                                                    </form>
                                                </td> --}}
                                            @endif

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
