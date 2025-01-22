<?php

namespace App;

class Constants
{
    public const IR = [
        1 => 'Intermediate Result 1. Improved Household Nutrition Practices',
        2 => 'Intermediate Result 2: Improved quality and coverage of nutrition services',
        3 => 'Intermediate Result 3: Improved access to safe, diverse, and nutritious foods',
        4 => 'Intermediate Result 4: Strengthened national and subnational government capacity for multi-sectoral nutrition programming',
    ];

    public const PARTNERS = [
        '1' => 'Helen Keller Intl',
        '2' => 'FHI360',
        '3' => 'CEAPRED',
        '4' => 'ENPHO',
        '5' => 'NTAG',
        '6' => 'KABOOM',
        '7' => 'PNGO'
    ];
    public const IMPLEMENTOR = [
        '1' => 'Federal',
        '2' => 'Province',
        '3' => 'Local',        
    ];
    public const Year = [
        '1' => 'Year 1',
        '2' => 'Year 2',
        '3' => 'Year 3',        
    ];
    public const ACTIVITIESTYPE = [
        '1' => 'Program Managment',
        '2' => 'Finance and Operations',
        '3' => 'Intermediate Result',        
        '4' => 'Gender and Inclusive Development',        
        '5' => 'Monitoring, Evaluation, Research and Learning',        
        '6' => 'Resilience and Shock Response',        
        '7' => 'Diverse Partnersips (Private Sector, Academia, CSOs)',        
        '8' => 'SBC',        
    ];
    public const TARGETEDFOR = [
        '1' => 'All',
        '2' => 'Vulnerable',
        '3' => 'Selected',        
        '4' => 'Other',
    ];
    
    public const MONTHS = [
        '1' => 'January',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
    ];
    
    public const ATTRIBUTES = [
        1 => [
            'name' => 'Gender',
            'subcategories' => [
                1 => 'Male',
                2 => 'Female',
                3 => 'Other',
            ],
        ],
        2 => [
            'name' => 'Age',
            'subcategories' => [
                1 => 'Less than 20 years',
                2 => '20-29 years',
                3 => '30 and above years',
            ],
        ],
        3 => [
            'name' => 'Types of participants',
            'subcategories' => [
                1 => 'Health worker',
                2 => 'FCHV',
                3 => 'NGO workers',
                4 => '1000 days mother',
                5 => 'Adolescent',
                6 => 'School age children',
                7 => 'Caregiver and family member',
                8 => 'Agricultural extension worker',
                9 => 'WASH extension worker',
                10 => 'School teacher',
                11 => 'Private sectors',
                12 => 'Traditional healer',
                13 => 'Community Campaign/celebrities',
                14 => 'Government Officials',
                15 => 'Elected member',
                16 => 'Trainer',
                17 => 'Observer',
                18 => 'Other',
            ],
        ],
        4 => [
            'name' => 'Caste/Ethnicity',
            'subcategories' => [
                1 => 'Hill Brahmin/Chhetri',
                2 => 'Madheshi Brahmin/Chhetri',
                3 => 'Madheshi Other Castes',
                4 => 'Mountain/Hill Dalit',
                5 => 'Madheshi Dalit',
                6 => 'Newar',
                7 => 'Mountain/Hill Janajati',
                8 => 'Tarai Janajati',
                9 => 'Muslim',
                10 => 'Other',
            ],
        ],
        5 => [
            'name' => 'Disability',
            'subcategories' => [
                1 => 'No disability',
                2 => 'Person with disability',
            ],
        ],
        6 => [
            'name' => 'Types of health worker',
            'subcategories' => [
                1 => 'Medical Officer',
                2 => 'Staff Nurse',
                3 => 'HA',
                4 => 'ANW/ANM',
                5 => 'Other',
            ],
        ],
        7 => [
            'name' => 'Types of Health facility',
            'subcategories' => [
                1 => 'Hospital',
                2 => 'PHCC',
                3 => 'HP',
                4 => 'BHCC',
                5 => 'UHC',
                6 => 'CHU',
            ],
        ],
        8 => [
            'name' => 'Total Number',
            'subcategories' => [
                1 => 'Total Number'
                
            ],
        ],
    ];
}
