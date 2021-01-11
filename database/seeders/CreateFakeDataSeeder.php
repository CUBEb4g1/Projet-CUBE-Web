<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Relation;
use App\Models\ResourceType;
use Illuminate\Database\Seeder;

class CreateFakeDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Relation::create([
            'label' => 'Relations1',
        ]);

        Category::create([
            'label' => 'Category1',
        ]);

        ResourceType::create([
            'label' => 'ResourceType1',
        ]);
    }
}
