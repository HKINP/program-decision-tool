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
            ['province' => 'Koshi Pradesh'],
            ['province' => 'Madhesh Pradesh'],
            ['province' => 'Bagmati Pradesh'],
            ['province' => 'Gandaki Pradesh'],
            ['province' => 'Lumbini Pradesh'],
            ['province' => 'Karnali Pradesh'],
            ['province' => 'Sudur Paschhim Pradesh'],
        ]);
    }
}
