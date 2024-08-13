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
            'Exclusive breastfeeding for 6 months',
            'Continued breastfeeding (until 24 months)',
            'Minimum meal frequency',
            'Minimum dietary diversity (4+ food groups for Children 6-23 months)',
            'Egg and/or flesh food consumption',
            'Sweet beverage consumption (Children 6-23 months)',
            'Unhealthy food consumption (Children 6-23 months)',
            'Took vitamin A capsule',
            'Taken to a health care provider when ill (diarrhea)',
            'Given more liquids (or breast milk) when ill (diarrhea)',
            'Fed the same amount of solids when ill (diarrhea)',
            'Given ORS during diarrhea',
            'Given Zinc during diarrhea',
            'Enrolled in treatment for wasting',
            'Screened for wasting by FCHV',
            'Took iron-folic acid (IFA) supplementation',
            'Took iron-folic acid (IFA) for 13 weeks',
            'Use modern contraceptive method (Adolescent girls 15-19 years)',
            'Completed 4+ antenatal care (ANC) visits',
            'Took 180+ IFA',
            'Delivered at a health facility',
            'Received a postnatal care (PNC) visit within 24 hours of birth',
            'Minimum dietary diversity ((4+ food groups for women 15-49 years))',
            'Sweet beverage consumption (Women 15-49 years)',
            'Unhealthy food consumption (Women 15-49 years)',
            'Use modern contraceptive method (Women girls 15-49 years)',
            'Drink safe (treated) drinking water',
            'Have a fixed handwashing facility',
            'Have a latrine',
            'Safely dispose child stool'
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
