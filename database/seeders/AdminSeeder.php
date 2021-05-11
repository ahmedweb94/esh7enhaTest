<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::firstOrCreate(
            [
                'email' => 'super_admin@fudex.com.sa'
            ],
            [
                'name' => 'Adminstrator',
                'email' => "super_admin@fudex.com.sa",
                'phone' => '0123456789',
                'password' => bcrypt("password"),
                'is_active' => 1,
            ]
        );
    }
}
