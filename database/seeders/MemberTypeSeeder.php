<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Ordinary', 'description' => 'Standard individual membership'],
            ['name' => 'Group', 'description' => 'Group or association membership'],
            ['name' => 'Associate', 'description' => 'Associate membership'],
            ['name' => 'Business Associate', 'description' => 'Business associate membership'],
            ['name' => 'Scholar', 'description' => 'Scholarship student membership'],
            ['name' => 'Regular', 'description' => 'Regular membership'],
            ['name' => 'Junior', 'description' => 'Youth or junior membership'],
            ['name' => 'Institutional', 'description' => 'Institutional membership'],
        ];
        
        foreach ($types as $type) {
            \App\Models\MemberType::firstOrCreate($type);
        }
    }
}


