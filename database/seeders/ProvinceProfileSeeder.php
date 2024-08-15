<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceProfileSeeder extends Seeder
{
    public function run()
    {
        DB::table('province_profile')->insert([
            ['id' => 4, 'province_id' => 5, 'indicator_id' => 1, 'all_value' => '62', 'rural_value' => '68', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 5, 'province_id' => 5, 'indicator_id' => 2, 'all_value' => '36', 'rural_value' => '0', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 6, 'province_id' => 5, 'indicator_id' => 3, 'all_value' => '95', 'rural_value' => '93', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 7, 'province_id' => 5, 'indicator_id' => 4, 'all_value' => '52', 'rural_value' => '50', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 8, 'province_id' => 5, 'indicator_id' => 5, 'all_value' => '84', 'rural_value' => '90', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 9, 'province_id' => 5, 'indicator_id' => 6, 'all_value' => '41', 'rural_value' => '38', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 10, 'province_id' => 5, 'indicator_id' => 7, 'all_value' => '72', 'rural_value' => '76', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 11, 'province_id' => 5, 'indicator_id' => 8, 'all_value' => '38', 'rural_value' => '31', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 12, 'province_id' => 5, 'indicator_id' => 9, 'all_value' => '88', 'rural_value' => '91', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 13, 'province_id' => 5, 'indicator_id' => 10, 'all_value' => '65', 'rural_value' => '79', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 14, 'province_id' => 5, 'indicator_id' => 11, 'all_value' => '22', 'rural_value' => '7', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 15, 'province_id' => 5, 'indicator_id' => 12, 'all_value' => '52', 'rural_value' => '61', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 16, 'province_id' => 5, 'indicator_id' => 13, 'all_value' => '37', 'rural_value' => '0', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 17, 'province_id' => 5, 'indicator_id' => 14, 'all_value' => '29', 'rural_value' => '0', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 18, 'province_id' => 5, 'indicator_id' => 15, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 19, 'province_id' => 5, 'indicator_id' => 16, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 20, 'province_id' => 5, 'indicator_id' => 17, 'all_value' => '28', 'rural_value' => '30', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 21, 'province_id' => 5, 'indicator_id' => 18, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 22, 'province_id' => 5, 'indicator_id' => 19, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 23, 'province_id' => 5, 'indicator_id' => 20, 'all_value' => '86', 'rural_value' => '87', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 24, 'province_id' => 5, 'indicator_id' => 21, 'all_value' => '73', 'rural_value' => '77', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 25, 'province_id' => 5, 'indicator_id' => 22, 'all_value' => '84', 'rural_value' => '85', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 26, 'province_id' => 5, 'indicator_id' => 23, 'all_value' => '63', 'rural_value' => '59', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 27, 'province_id' => 5, 'indicator_id' => 24, 'all_value' => '53', 'rural_value' => '52', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 28, 'province_id' => 5, 'indicator_id' => 25, 'all_value' => '43', 'rural_value' => '46', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 29, 'province_id' => 5, 'indicator_id' => 26, 'all_value' => '24', 'rural_value' => '21', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 30, 'province_id' => 5, 'indicator_id' => 27, 'all_value' => '17', 'rural_value' => '18', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 31, 'province_id' => 5, 'indicator_id' => 28, 'all_value' => '35', 'rural_value' => '38', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 32, 'province_id' => 5, 'indicator_id' => 29, 'all_value' => '67', 'rural_value' => '65', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 33, 'province_id' => 5, 'indicator_id' => 30, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 34, 'province_id' => 5, 'indicator_id' => 31, 'all_value' => '41', 'rural_value' => '43', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 35, 'province_id' => 5, 'indicator_id' => 32, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 36, 'province_id' => 5, 'indicator_id' => 33, 'all_value' => '29', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 37, 'province_id' => 5, 'indicator_id' => 34, 'all_value' => '58', 'rural_value' => '56', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 38, 'province_id' => 5, 'indicator_id' => 35, 'all_value' => '59', 'rural_value' => '58', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 39, 'province_id' => 5, 'indicator_id' => 36, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 40, 'province_id' => 5, 'indicator_id' => 37, 'all_value' => '69', 'rural_value' => '72', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 41, 'province_id' => 5, 'indicator_id' => 38, 'all_value' => '46', 'rural_value' => '52', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 42, 'province_id' => 5, 'indicator_id' => 39, 'all_value' => '47', 'rural_value' => '49', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 43, 'province_id' => 5, 'indicator_id' => 40, 'all_value' => '20', 'rural_value' => '16', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 44, 'province_id' => 5, 'indicator_id' => 41, 'all_value' => '10', 'rural_value' => '8', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 45, 'province_id' => 5, 'indicator_id' => 42, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 46, 'province_id' => 5, 'indicator_id' => 43, 'all_value' => '62', 'rural_value' => '59', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 47, 'province_id' => 5, 'indicator_id' => 44, 'all_value' => '62', 'rural_value' => '67', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 48, 'province_id' => 5, 'indicator_id' => 45, 'all_value' => '77', 'rural_value' => '73', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 49, 'province_id' => 5, 'indicator_id' => 46, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
            ['id' => 50, 'province_id' => 5, 'indicator_id' => 47, 'all_value' => '56', 'rural_value' => '54', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 51, 'province_id' => 5, 'indicator_id' => 48, 'all_value' => '39', 'rural_value' => '42', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 52, 'province_id' => 5, 'indicator_id' => 49, 'all_value' => '60', 'rural_value' => '56', 'source' => 'NDHS 2022', 'updated_by' => 1],
            ['id' => 53, 'province_id' => 5, 'indicator_id' => 50, 'all_value' => '0', 'rural_value' => '0', 'source' => 'NA', 'updated_by' => 1],
        ]);
    }
}
