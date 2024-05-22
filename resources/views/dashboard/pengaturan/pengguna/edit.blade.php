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
                    <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" class="block mt-1 w-full " type="text" name="name"
                                :value="old('name', $user->name)" required autofocus autocomplete="off" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                :value="old('email', $user->email)" required autocomplete="off" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                            <x-text-input id="update_password_current_password" name="current_password" type="password"
                                class="mt-1 block w-full" autocomplete="off" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="password" :value="__('Password')" />
                            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                                required autocomplete="off" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                                name="password_confirmation" required autocomplete="off" />

                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="kontak_id"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                                Lengkap</label>
                            <select name="kontak_id" id="kontak_id" required
                                class="capitalize mt-1 p-2 w-full border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-300">
                                <option value="0" @if ($user->status == 'active' ?? 'active') selected @endif>active</option>
                                <option value="1" @if ($user->status == 'non-active' ?? 'non-active') selected @endif>non-active
                                </option>
                            </select>
                        </div>
                        <!-- Grid layout untuk buttons -->
                        <div class="grid grid-cols-2 gap-4">
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
