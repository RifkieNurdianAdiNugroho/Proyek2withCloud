<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'Admin',
                'role' => 'admin',
                'email' => 'admin@viggy.com',
                'password' => Hash::make('secret123'),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Penjual',
                'role' => 'penjual',
                'email' => 'penjual@viggy.com',
                'password' => Hash::make('secret123'),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => 'Pembeli',
                'role' => 'pembeli',
                'email' => 'pembeli@viggy.com',
                'password' => Hash::make('secret123'),
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
