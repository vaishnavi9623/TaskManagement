<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
// use Faker\Factory as Faker;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'designation' => 'Java developer',
                'password' => md5('password123'), 
                'email_verified_at' => now(), 
                'remember_token' => Str::random(10), 
                'created_at' => now(),
                'updated_at' => now(),
                'photo' => '',
                'status' => 'active',
                'role' => 'user',
                'phone_number' => '9087654321',
                'last_login_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'designation' => 'Ionic developer',

                'password' => md5('secret456'), 
                'email_verified_at' => now(), 
                'remember_token' => Str::random(10), 
                'created_at' => now(),
                'updated_at' => now(),
                'photo' => '',
                'status' => 'active',
                'role' => 'user',
                'phone_number' => '9087654321',
                'last_login_at' => now(),
            ],
            [
                'name' => 'Mark Johnson',
                'email' => 'mark@example.com',
                'designation' => 'Designer',

                'password' => md5('123456789'), 
                'email_verified_at' => now(), 
                'remember_token' => Str::random(10), 
                'created_at' => now(),
                'updated_at' => now(),
                'photo' => '',
                'status' => 'active',
                'role' => 'user',
                'phone_number' => '9087654321',
                'last_login_at' => now(),
            ],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'designation' => 'Tester',
                'password' => md5('123456789'), 
                'email_verified_at' => now(), 
                'remember_token' => Str::random(10), 
                'created_at' => now(),
                'updated_at' => now(),
                'photo' => '',
                'status' => 'active',
                'role' => 'user',
                'phone_number' => '9087654321',
                'last_login_at' => now(),
            ],
        ]);
    }
}
