<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Seed the questions table.
     *
     * @return void
     */
    public function run()
    {
        $questions = [
            ['target_group_id' => 1, 'thematic_area_id' => 1, 'question' => 'What proportion of children are breastfed within the first hour of birth?', 'indicator_id' => 1],
            ['target_group_id' => 1, 'thematic_area_id' => 1, 'question' => 'What proportion of children are breastfed exclusively for 6 months after birth?', 'indicator_id' => 2],
            ['target_group_id' => 1, 'thematic_area_id' => 1, 'question' => 'What proportion of children are breastfed until at least 24 months of age?', 'indicator_id' => 3],
            ['target_group_id' => 1, 'thematic_area_id' => 2, 'question' => 'What proportion of children 6-23 months are fed the age-appropriate frequency of foods?', 'indicator_id' => 4],
            ['target_group_id' => 1, 'thematic_area_id' => 2, 'question' => 'What proportion of children 6-23 months have minimum dietary diversity (4+ food groups)?', 'indicator_id' => 5],
            ['target_group_id' => 1, 'thematic_area_id' => 2, 'question' => 'What proportion of children 6-23 months are fed eggs and flesh foods?', 'indicator_id' => 6],
            ['target_group_id' => 1, 'thematic_area_id' => 2, 'question' => 'What proportion of children 6-23 months consume sweet beverages?', 'indicator_id' => 7],
            ['target_group_id' => 1, 'thematic_area_id' => 2, 'question' => 'What proportion of children 6-23 months consume unhealthy foods?', 'indicator_id' => 8],
            ['target_group_id' => 1, 'thematic_area_id' => 2, 'question' => 'What proportion of children 6-59 months received a vitamin A capsule?', 'indicator_id' => 9],
            ['target_group_id' => 1, 'thematic_area_id' => 3, 'question' => 'What proportion of children 0-59 months are taken to a health care provider when ill (diarrhea)?', 'indicator_id' => 10],
            ['target_group_id' => 1, 'thematic_area_id' => 3, 'question' => 'What proportion of children 0-59 months are given more liquids (or breast milk) when ill (diarrhea)?', 'indicator_id' => 11],
            ['target_group_id' => 1, 'thematic_area_id' => 3, 'question' => 'What proportion of children 0-59 months are fed the same amount of solids when ill (diarrhea)?', 'indicator_id' => 12],
            ['target_group_id' => 1, 'thematic_area_id' => 3, 'question' => 'What proportion of children 6-59 months received ORS during diarrhea?', 'indicator_id' => 13],
            ['target_group_id' => 1, 'thematic_area_id' => 3, 'question' => 'What proportion of children 6-59 months received Zinc during diarrhea?', 'indicator_id' => 14],
            ['target_group_id' => 1, 'thematic_area_id' => 4, 'question' => 'What proportion of children 0-59 months with wasting receive treatment?', 'indicator_id' => 15],
            ['target_group_id' => 1, 'thematic_area_id' => 4, 'question' => 'What proportion of children 0-59 months are screened for wasting?', 'indicator_id' => 16],
            ['target_group_id' => 2, 'thematic_area_id' => 5, 'question' => 'What proportion of adolescent girls 15-19 years take iron-folic acid (IFA) supplementation?', 'indicator_id' => 17],
            ['target_group_id' => 2, 'thematic_area_id' => 5, 'question' => 'What proportion of adolescent girls 15-19 years take iron-folic acid (IFA) for 13 weeks?', 'indicator_id' => 18],
            ['target_group_id' => 2, 'thematic_area_id' => 5, 'question' => 'What proportion of adolescent girls 15-19 years take iron-folic acid (IFA) for 26 weeks?', 'indicator_id' => 19],
            ['target_group_id' => 3, 'thematic_area_id' => 6, 'question' => 'What proportion of pregnant women complete 4+ antenatal care (ANC) visits?', 'indicator_id' => 20],
            ['target_group_id' => 3, 'thematic_area_id' => 6, 'question' => 'What proportion of pregnant women take 180+ days of IFA?', 'indicator_id' => 21],
            ['target_group_id' => 3, 'thematic_area_id' => 6, 'question' => 'What proportion of pregnant women deliver at a health facility?', 'indicator_id' => 22],
            ['target_group_id' => 3, 'thematic_area_id' => 7, 'question' => 'What proportion of mothers received a postnatal care (PNC) visit within 24 hours of birth?', 'indicator_id' => 23],
            ['target_group_id' => 3, 'thematic_area_id' => 5, 'question' => 'What proportion of women (15-49 years) have minimum dietary diversity (4+ food groups)?', 'indicator_id' => 24],
            ['target_group_id' => 3, 'thematic_area_id' => 5, 'question' => 'What proportion of women (15-49 years) consume sweet beverages?', 'indicator_id' => 25],
            ['target_group_id' => 3, 'thematic_area_id' => 5, 'question' => 'What proportion of women (15-49 years) consume unhealthy foods?', 'indicator_id' => 26],
            ['target_group_id' => 3, 'thematic_area_id' => 8, 'question' => 'What proportion of women (15-19 years) use a modern contraceptive method?', 'indicator_id' => 27],
            ['target_group_id' => 4, 'thematic_area_id' => 9, 'question' => 'What proportion of family members drink safe (treated) drinking water?', 'indicator_id' => 28],
            ['target_group_id' => 4, 'thematic_area_id' => 10, 'question' => 'What proportion of households have a fixed handwashing facility?', 'indicator_id' => 29],
            ['target_group_id' => 4, 'thematic_area_id' => 11, 'question' => 'What proportion of households have a latrine?', 'indicator_id' => 20],
            ['target_group_id' => 4, 'thematic_area_id' => 11, 'question' => 'What proportion of family members safely dispose child stool?', 'indicator_id' => 31],
        ];

        foreach ($questions as $question) {
            DB::table('questions')->insert([
                'target_group_id' => $question['target_group_id'],
                'thematic_area_id' => $question['thematic_area_id'],
                'question' => $question['question'],
                'indicator_id' => $question['indicator_id'],
                'updated_by' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
