<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Resource;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('fr_FR');
        for ($i = 1; $i <= 1507; $i++) {
            $r1 = new Resource();

            $r1->user_id = rand(1,3);
            $r1->title = $faker->sentence;
            $r1->content = implode($faker->paragraphs(10));
            $r1->visibility = rand(0, 3);
            $r1->validated = rand(0, 1);
            $r1->deleted = rand(0, 1);
            $r1->views = rand(0, 999);
            $r1->relation_id = 1;
            $r1->category_id = 1;
            $r1->resource_type_id = 1;

            $r1->save();
        }

    }
}
