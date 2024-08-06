<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('districts')->insert([
            ['province_id' => 1, 'district' => 'Okhaldhunga', 'updated_by' => 1],
            ['province_id' => 1, 'district' => 'Khotang', 'updated_by' => 1],
            ['province_id' => 1, 'district' => 'Bhojpur', 'updated_by' => 1],
            ['province_id' => 1, 'district' => 'Udayapur', 'updated_by' => 1],
            ['province_id' => 2, 'district' => 'Saptari', 'updated_by' => 1],
            ['province_id' => 2, 'district' => 'Siraha', 'updated_by' => 1],
            ['province_id' => 2, 'district' => 'Dhanusa', 'updated_by' => 1],
            ['province_id' => 2, 'district' => 'Mahottari', 'updated_by' => 1],
            ['province_id' => 2, 'district' => 'Sarlahi', 'updated_by' => 1],
            ['province_id' => 2, 'district' => 'Rautahat', 'updated_by' => 1],
            ['province_id' => 2, 'district' => 'Bara', 'updated_by' => 1],
            ['province_id' => 3, 'district' => 'Sindhupalchok', 'updated_by' => 1],
            ['province_id' => 3, 'district' => 'Dhading', 'updated_by' => 1],
            ['province_id' => 3, 'district' => 'Ramechhap', 'updated_by' => 1],
            ['province_id' => 3, 'district' => 'Sindhuli', 'updated_by' => 1],
            ['province_id' => 3, 'district' => 'Makwanpur', 'updated_by' => 1],
            ['province_id' => 4, 'district' => 'Gorkha', 'updated_by' => 1],
            ['province_id' => 4, 'district' => 'Myagdi', 'updated_by' => 1],
            ['province_id' => 4, 'district' => 'Baglung', 'updated_by' => 1],
            ['province_id' => 5, 'district' => 'Rukum (East)', 'updated_by' => 1],
            ['province_id' => 5, 'district' => 'Rolpa', 'updated_by' => 1],
            ['province_id' => 5, 'district' => 'Pyuthan', 'updated_by' => 1],
            ['province_id' => 5, 'district' => 'Dang', 'updated_by' => 1],
            ['province_id' => 5, 'district' => 'Banke', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Dolpa', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Mugu', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Humla', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Jumla', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Kalikot', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Dailekh', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Jajarkot', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Rukum (West)', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Salyan', 'updated_by' => 1],
            ['province_id' => 6, 'district' => 'Surkhet', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Bajura', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Bajhang', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Darchula', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Baitadi', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Dadeldhura', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Doti', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Achham', 'updated_by' => 1],
            ['province_id' => 7, 'district' => 'Kailali', 'updated_by' => 1],
        ]);
    }
}
