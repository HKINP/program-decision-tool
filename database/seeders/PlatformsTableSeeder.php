<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('platforms')->insert([
            ['parent_id' => null, 'platforms' => 'Antenatal Care (ANC)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'ASF production (livestock, fishery)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'CF seal', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Climate-smart HFP (fruit & veg)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'CLTS', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'CNSI', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Digital', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Early Childhood Development Center (ECDC)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Expanded Program on Immunization (EPI)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Gender integration', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Growth Monitoring and Promotion (GMP)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'GoN input subsidies, insurance', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Health facilities', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Health facility', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Health Mothers Group (HMG)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Home', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Integrated Management of Acute Malnutrition (IMAM)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Integrated Management of Newborn and Childhood Illness (IMNCI)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Indigenous crop-based foods', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'MBFHI', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'NFSSC (local)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'NFSSC (ward)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'NSA curriculum', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Postnatal Care (PNC)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Post-harvest management', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Private facility', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Private sector', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Producer groups', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'School', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Social protection', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Village Savings and Loan Association (VSLAs)', 'updated_by' => 1],
            ['parent_id' => null, 'platforms' => 'Others', 'updated_by' => 1],
        ]);
    }
}
