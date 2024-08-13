<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OutcomesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('outcomes')->insert([
            ['id' => 1, 'ir_id' => 1, 'outcome' => 'Outcome 1.1 Households Adopt Essential Nutrition Actions, Including Maternal Nutrition, Infant and Young Child Feeding and Family Planning', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 2, 'ir_id' => 1, 'outcome' => 'Outcome 1.2 Households Adopt WASH and Other Environmental Actions', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 3, 'ir_id' => 1, 'outcome' => 'Outcome 1.3 Strengthening Enabling Environment and Household Support for Nutrition Needs of Female Family Members and Childcare', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 4, 'ir_id' => 2, 'outcome' => 'Outcome 2.1: Increased Availability and Access to High-Quality Nutrition-Specific and Nutrition-Sensitive Services and MCHN/FP Commodities for Women', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 5, 'ir_id' => 2, 'outcome' => 'Outcome 2.2: Strengthened Adolescent Nutrition Services Provided by the Health and Education Sector', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 6, 'ir_id' => 2, 'outcome' => 'Outcome 2.3: Expanded Availability and Access to High-Quality Nutrition Services for Infants and Children Under Five Years of Age', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 7, 'ir_id' => 3, 'outcome' => 'Outcome 3.1: Increased and Sustained Local Food Production of Nutrient-Rich Foods', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 8, 'ir_id' => 3, 'outcome' => 'Outcome 3.2: Increased Income Leads to Improved Diets', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 9, 'ir_id' => 3, 'outcome' => 'Outcome 3.3: Increased Year-Round Availability of and Access to Safe and Nutrient-Rich Foods', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 10, 'ir_id' => 4, 'outcome' => 'Outcome 4.1: Strengthened Policy Enabling Environment to Ensure Sustained Commitment to and Resources for Nutrition Programs', 'total_budget' => 'NA', 'updated_by' => 1],
            ['id' => 11, 'ir_id' => 4, 'outcome' => 'Outcome 4.2: Enhanced Human Resource Capacity to Implement Nutrition-Specific and Sensitive Interventions', 'total_budget' => 'NA', 'updated_by' => 1],
        ]);
    }
}
