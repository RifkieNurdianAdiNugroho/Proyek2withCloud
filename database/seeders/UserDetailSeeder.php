<?php

namespace Database\Seeders;

use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDetail::insert([
            [
                'user_id' => 2,
                'gender' => 'Laki-laki',
                'address' => 'Malang',
                'phone_number' => '08123456789',
                'created_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'gender' => 'Perempuan',
                'address' => 'Pakis, Malang',
                'phone_number' => '08987654321',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
