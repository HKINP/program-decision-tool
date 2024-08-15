<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformsTableSeeder extends Seeder
{
    public function run()
    {
        $platforms = [
            ['platforms' => 'Antenatal Care (ANC)', 'updated_by' => 1],
            ['platforms' => 'Child Club', 'updated_by' => 1],
            ['platforms' => 'Digital', 'updated_by' => 1],
            ['platforms' => 'Early Childhood Development Center (ECDC)', 'updated_by' => 1],
            ['platforms' => 'Expanded Program on Immunization (EPI)', 'updated_by' => 1],
            ['platforms' => 'Growth Monitoring and Promotion (GMP)', 'updated_by' => 1],
            ['platforms' => 'Health Facility Operations Management Committee (HFOMC)', 'updated_by' => 1],
            ['platforms' => 'Health Mothers Group (HMG)', 'updated_by' => 1],
            ['platforms' => 'Home', 'updated_by' => 1],
            ['platforms' => 'Integrated Management of Acute Malnutrition (IMAM)', 'updated_by' => 1],
            ['platforms' => 'Integrated Management of Newborn and Childhood Illness (IMNCI)', 'updated_by' => 1],
            ['platforms' => 'Nutrition and Food Security Steering Committee (NFSSC)', 'updated_by' => 1],
            ['platforms' => 'Others', 'updated_by' => 1],
            ['platforms' => 'Postnatal Care (PNC)', 'updated_by' => 1],
            ['platforms' => 'Private health facility', 'updated_by' => 1],
            ['platforms' => 'Private sector', 'updated_by' => 1],
            ['platforms' => 'Producer groups', 'updated_by' => 1],
            ['platforms' => 'Public health facility', 'updated_by' => 1],
            ['platforms' => 'School', 'updated_by' => 1],
            ['platforms' => 'Social protection', 'updated_by' => 1],
            ['platforms' => 'Village Savings and Loan Association (VSLAs)', 'updated_by' => 1],
        ];

        DB::table('platforms')->insert($platforms);
    }
}
