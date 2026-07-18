<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo tài khoản admin cố định
        DB::table('users')->insert([
            'fullname' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'phone' => '0999999999',
            'address' => 'Vietnam',
            'gender' => 1,
            'birthday' => '2000-01-01',
            'role' => 1, // 1: Admin
            'status' => 1, // Hoạt động
            'created_at' => now(),
            'updated_at' => now()
        ]);

        for ($i = 1; $i <= 19; $i++) {
            DB::table('users')->insert([
                'fullname' => fake()->name(),
                'username' => fake()->unique()->userName(),
                'email' => fake()->unique()->safeEmail(),
                'password' => bcrypt('123456'),
                'phone' => fake()->unique()->numerify('09########'),
                'address' => fake()->address(),
                'gender' => fake()->numberBetween(0, 2),
                'birthday' => fake()->date(),
                'role' => fake()->numberBetween(1, 2),
                'status' => fake()->numberBetween(0, 1),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}