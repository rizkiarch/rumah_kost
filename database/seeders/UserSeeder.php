<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Ikay Bhaskara Narendra',
            'email' => 'ikay@rumahkost.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'created_at' => now(),
            'updated_at' => now(),
            'status' => 'active',
        ]);
    }
}
