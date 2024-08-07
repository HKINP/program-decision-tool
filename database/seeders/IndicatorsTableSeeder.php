<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IndicatorsTableSeeder extends Seeder
{
    /**
     * Seed the indicators table.
     *
     * @return void
     */
    public function run()
    {
        $indicators = [
            'Early initiation of breastfeeding',
            'Exclusive breastfeeding',
            'Breastfeeding until 24 months',
            'Child MDD',
            'Child MMF',
            'Child sweet beverages',
            'Child unhealthy foods',
            'Eggs and/or flesh food',
            'Vitamin A Capsule',
            'Child taken to a health care provider when ill',
            'Child given more liquids (or breast milk) when ill',
            'Child fed the same amount of solids when ill',
            'ORS during child diarrhea',
            'Zinc during child diarrhea',
            '% SAM/ MAM screening by FCHV',
            'Child with wasting enrolled in treatment',
            'Adolescent Received IFA',
            'Adolescent IFA: 13 weeks',
            'Adolescent IFA: 26 weeks',
            'Maternal 4+ANC',
            'Maternal 180+ IFA',
            'Institutional delivery',
            'Women sweet beverages',
            'Women unhealthy foods',
            'Women modern contraception',
            'Household using appropriate water treatment method before drinking',
            'Household handwashing facility',
            'Household latrine',
            'Household safe disposal of child stool',
            'PNC within 24 hours',
        ];

        foreach ($indicators as $indicator) {
            DB::table('indicators')->insert([
                'indicator_name' => $indicator,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
