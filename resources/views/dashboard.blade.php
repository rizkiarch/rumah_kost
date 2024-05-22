<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-xl mb-2">Kontak</h3>
                        <p>Jumlah Kontak:
                            <span id="contactCount"></span>
                        </p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-xl mb-2">Jadwal Aktif</h3>
                        <p>Jumlah Jadwal Aktif: <span id="scheduleCount"></span></p>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="font-bold text-xl mb-2">Laporan Pesan Terkirim</h3>
                        <p>Jumlah Laporan Pesan Terkirim: <span id="reportCount"></span> </p>
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
                                        <th scope="col"
                                            class="relative px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="paymentTableBody"
                                    class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                                    @if ($tablePembayaran->isEmpty())
                                        <tr>
                                            <td colspan="5"
                                                class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 text-center">
                                                Tidak ada data </td>
                                        </tr>
                                    @else
                                        @foreach ($tablePembayaran as $payment)
                                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 capitalize">
                                                    {{ $payment->kontak->nama_lengkap }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                    {{ $payment->kontak->no_telpon }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                    {{ $payment->tanggal_pembayaran }}
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                    {{ $payment->nominal }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('payment.edit', $payment->id) }}"
                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-700">Edit</a>
                                                    <form action="{{ route('payment.destroy', $payment->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-700 ml-2">Hapus</button>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $tablePembayaran->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        fetch('/api/dashboard')
            .then(response => response.json())
            .then(data => {
                console.log(data.tablePembayaran.data);
                const paymentData = data.tablePembayaran.data;

                // Update your frontend elements with the data
                document.getElementById('contactCount').textContent = data.contactCount;
                document.getElementById('scheduleCount').textContent = data.scheduleCount;
                document.getElementById('reportCount').textContent = data.reportCount;

                let tableBody = '';
                paymentData.forEach(payment => {
                    tableBody += `
                        <tr>
                        <td>${payment.kontak.nama_lengkap}</td>
                        <td>${payment.kontak.no_telpon}</td>
                        <td>${payment.tanggal_pembayaran}</td>
                        <td>${payment.nominal}</td>
                        <td>
                            <a href="${route('payment.edit', payment.id)}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="${route('payment.destroy', payment.id)}" method="POST" class="inline d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                        </tr>
                    `;
                });
                document.getElementById('paymentTableBody').innerHTML = tableBody;

            });
    </script>

</x-app-layout>
