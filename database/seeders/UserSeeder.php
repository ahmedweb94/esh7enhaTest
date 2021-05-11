<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::firstOrCreate(
            [
                'phone' => '0123456789'
            ],
            [
                'name' => 'inas',
                'email' => "inas@fudex.com.sa",
                'phone' => '0123456789',
                'password' => bcrypt("password"),
                'is_active' => 1,
            ]
        );
    }
}
