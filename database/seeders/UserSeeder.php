<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->insert([
            [
                'name' => 'User',
                'email' => 'user@mail.com',
                'password' => Hash::make('admin786'),
                'social_token' => NULL,
                'social_providers' => NULL,
                'picture' => '/uploads/images/users/Vector-5.png',
                'status' => 1,
                'created_at' => now()->toDate(),
                'updated_at' => now()->toDate(),
            ],
            [
                'name' => 'G_User',
                'email' => 'asdasdqweqwr@',
                'password' => Hash::make('agfdfgsdfga'),
                'social_token' => 'asdasdqweqwr',
                'social_providers' => 'Google',
                'picture' => '/uploads/images/users/Vector-5.png',
                'status' => 1,
                'created_at' => now()->toDate(),
                'updated_at' => now()->toDate(),
            ]
        ]);
    }
}
