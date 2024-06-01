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
                         <h3 class="text-lg font-semibold">Daftar Kost</h3>
                         <a href="{{ route('kost.create') }}"
                             class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Tambah</a>
                     </div>
                     <div x-data="modalData()">
                         <div x-show="showModal" @click.away="showModal = false"
                             class="fixed z-10 inset-0 overflow-y-auto bg-gray-500 bg-opacity-75 transition-opacity">
                             <div
                                 class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                 <div x-show="showModal"
                                     class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                     aria-hidden="true"></div>
                                 <span class="hidden sm:inline-block sm:align-middle sm:h-screen"
                                     aria-hidden="true">&#8203;</span>
                                 <div x-show="showModal"
                                     class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                                     <div>
                                         <div
                                             class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                                             <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                                 fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                 aria-hidden="true">
                                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                     d="M6 18L18 6M6 6l12 12"></path>
                                             </svg>
                                         </div>
                                         <div class="mt-3 text-center sm:mt-5">
                                             <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-gray-100"
                                                 id="modal-title">Konfirmasi Penghapusan</h3>
                                             <div class="mt-2">
                                                 <p class="text-sm text-gray-500 dark:text-gray-300">Apakah Anda
                                                     yakin ingin menghapus data <span
                                                         class="text-red-400">{{ $title }} <span
                                                             x-text="nameData">? <span id="idData"></span></span>
                                                 </p>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="mt-5 sm:mt-6 sm:grid sm:grid-flow-row-dense sm:grid-cols-2 sm:gap-3">
                                         <button @click="showModal = false" type="button"
                                             class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white dark:bg-gray-700">Batal</button>
                                         <form x-bind:action="`/kost/${idData}`" method="POST">
                                             @csrf
                                             @method('DELETE')
                                             <button type="submit"
                                                 class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 sm:text-sm"
                                                 @click="showModal = false">Ya, Hapus</button>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="overflow-x-auto">
                             <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                 <thead class="bg-gray-50 dark:bg-gray-700">
                                     <tr>
                                         <th scope="col"
                                             class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                             Kode</th>
                                         <th scope="col"
                                             class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                             Nama</th>
                                         <th scope="col"
                                             class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                             Nominal</th>
                                         <th scope="col" class="relative px-6 py-3"></th>
                                     </tr>
                                 </thead>
                                 @if ($kosts->isEmpty())
                                     <tbody class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                                         <tr>
                                             <td colspan="3"
                                                 class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 text-center">
                                                 Tidak ada data </td>
                                         </tr>
                                     </tbody>
                                 @else
                                     @foreach ($kosts as $kost)
                                         <tbody class="bg-gray divide-y divide-gray-200 dark:divide-gray-700">
                                             <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                                 <td
                                                     class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100 capitalize">
                                                     {{ $kost->kode }}
                                                 </td>
                                                 <td
                                                     class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                     {{ $kost->nama_kost }}
                                                 </td>
                                                 <td
                                                     class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-gray-100">
                                                     <p>Rp {{ number_format($kost->nominal, 0, ',', '.') }}</p>
                                                 </td>
                                                 <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                     <a href="{{ route('kost.edit', $kost->id) }}"
                                                         class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-700">Edit</a>
                                                     <button
                                                         @click="showData('{{ $kost->nama_kost }}', {{ $kost->id }})"
                                                         class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-700 ml-2">Hapus</button>

                                                 </td>
                                             </tr>
                                         </tbody>
                                     @endforeach
                                 @endif
                             </table>
                         </div>
                     </div>

                     <div class="mt-4">
                         {{ $kosts->links() }}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </x-app-layout>
 <script>
     function modalData() {
         return {
             showModal: false,
             idData: '',
             nameData: '',
             showData(name, id) {
                 this.nameData = name;
                 this.idData = id;
                 this.showModal = true;
                 console.log(this.nameData, this.idData);
             }
         }
     }
 </script>
