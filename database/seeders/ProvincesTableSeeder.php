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
            ['province' => 'Koshi Pradesh', 'updated_by' => 1],
            ['province' => 'Madhesh Pradesh', 'updated_by' => 1],
            ['province' => 'Bagmati Pradesh', 'updated_by' => 1],
            ['province' => 'Gandaki Pradesh', 'updated_by' => 1],
            ['province' => 'Lumbini Pradesh', 'updated_by' => 1],
            ['province' => 'Karnali Pradesh', 'updated_by' => 1],
            ['province' => 'Sudur Paschhim Pradesh', 'updated_by' => 1],
        ]);
    }
}
