<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::query()->create(
            [
                'name' => 'super admin',
                'email' => 'admin@lema.org',
                'phone' => '01014636418',
                'password' => Hash::make('123456789'),
                'is_active'=> 1,
                'is_super' => 1,
            ]
        );
    }
}
