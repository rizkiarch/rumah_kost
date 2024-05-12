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
                        <h3 class="text-lg font-semibold">Daftar Pesan Terjadwal</h3>
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
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Tanggal Tagihan</th>
                                    <th scope="col" class="relative px-6 py-3"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                                @if ($jadwals->isEmpty())
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 text-center">
                                            Tidak ada data </td>
                                    </tr>
                                @else
                                    @foreach ($jadwals as $penghuni)
                                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 capitalize">
                                                {{ $penghuni->kontak->nama_lengkap }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                {{ $penghuni->kontak->no_telpon }}
                                            </td>
                                            <form action="{{ route('jadwal.store') }}" method="POST">
                                                @csrf
                                                <input type="text" readonly hidden name="kontak_id" id="kontak_id"
                                                    class="form-control mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                                    value="{{ $penghuni->id ?? '' }}">
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                    <select name="status" id="status"
                                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                                        <option value="0"
                                                            @if ($penghuni->status == '0' ?? '0') selected @endif>Tidak
                                                            Aktif</option>
                                                        <option value="1"
                                                            @if ($penghuni->status == '1' ?? 1) selected @endif>Aktif
                                                        </option>
                                                    </select>
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                    <input type="datetime-local" name="jadwal_kirim" id="jadwal_kirim"
                                                        class="form-control mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"
                                                        value="{{ $penghuni->jadwal_kirim ?? '' }}">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <button type="submit"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg text-sm">Simpan</button>
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{-- {{ $kontaks->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Get today's date in ISO 8601 format (YYYY-MM-DD)
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('jadwal_kirim{{ $penghuni->id }}').setAttribute('min', today);
    </script>
    {{-- <script>
        function updateData(id) {
            var kontak_id = document.getElementById('kontak_id_' + id).value;
            var status = document.getElementById('status_' + id).value; // Ambil value dari select dengan id tertentu
            var jadwal_kirim = document.getElementById('jadwal_kirim_' + id).value;
            // Ambil value dari input date dengan id tertentu
            var token = '{{ csrf_token() }}';

            var xhr = new XMLHttpRequest();
            xhr.open('PUT', '/jadwal/' + id, true);
            xhr.setRequestHeader('Content-Type', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', token);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);
                        alert('Data berhasil diperbarui'); // Tampilkan pesan sukses
                    } else {
                        console.error(xhr.status);
                        alert('Terjadi kesalahan'); // Tampilkan pesan error
                    }
                }
            };

            var formData = 'status=' + encodeURIComponent(status) + '&jadwal_kirim=' + encodeURIComponent(jadwal_kirim);
            xhr.send(formData);
            // function updateData(id) {
            //     let kontak_id = document.getElementById('kontak_id_' + id).value;
            //     let status = document.getElementById('status_' + id).value;
            //     let jadwal_kirim = document.getElementById('jadwal_kirim_' + id).value;

            //     fetch('/jadwal/' + id, {
            //             method: 'PUT',
            //             header: {
            //                 'Content-Type': 'application/json',
            //                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //             },
            //             body: JSON.stringify({
            //                 kontak_id: kontak_id,
            //                 status: status,
            //                 jadwal_kirim: jadwal_kirim
            //             })
            //         })
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error('Network response was not ok');
            //             }
            //             return response.json();
            //         })
            //         .then(data => {
            //             console.log(data);
            //             alert('Data berhasil diperbarui');
            //             location.reload();
            //         })
            //         .catch(error => {
            //             console.error('There has been a problem with your fetch operation:', error);
            //             alert('Terjadi kesalahan saat memperbarui data');
            //         });
        }
    </script> --}}
</x-app-layout>
