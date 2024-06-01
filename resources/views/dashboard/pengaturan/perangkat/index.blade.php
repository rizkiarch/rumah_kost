<x-app-layout>
    <?php
    $readonly = Auth::user()->role === 'pengelola' ? 'readonly' : '';
    
    ?>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('perangkat.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="no_telpon"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon
                                Pengirim</label>
                            <input type="number" {{ $readonly }} name="no_telpon" id="no_telpon"
                                value="{{ $setting->no_telpon ?? '' }}"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                        </div>
                        <div class="mb-4">
                            <label for="format_text"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Format Text</label>
                            {{-- <input type="text" name="format_text" id="format_text"
                                value="{{ $setting->format_text ?? '' }}"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"> --}}
                            <textarea name="format_text" id="format_text" cols="30" rows="3"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300"> {{ $setting->format_text ?? '' }}
                            </textarea>
                        </div>
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
