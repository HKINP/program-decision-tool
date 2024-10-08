<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Pravin Poudel",
            'email' => "PPoudel@hki.org",
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt('password'),
            'updated_by' =>1,
            'remember_token' => Str::random(10),         
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
