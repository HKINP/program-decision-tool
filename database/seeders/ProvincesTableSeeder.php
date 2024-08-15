<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provinces')->insert([
            ['province' => 'Koshi Province', 'updated_by' => 1],
            ['province' => 'Madhesh Province', 'updated_by' => 1],
            ['province' => 'Bagmati Province', 'updated_by' => 1],
            ['province' => 'Gandaki Province', 'updated_by' => 1],
            ['province' => 'Lumbini Province', 'updated_by' => 1],
            ['province' => 'Karnali Province', 'updated_by' => 1],
            ['province' => 'Sudurpashchim Province', 'updated_by' => 1],
        ]);
    }
}
