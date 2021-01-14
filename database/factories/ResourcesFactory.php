<?php

use Faker\Generator as Faker;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Factories\Factory;

function factory()
{
    $factory = app(Factory::class);

    $factory->define(Resource::class, function (Faker $faker) {
        return [
            'title' => $faker->sentence,
            'content' => implode($faker->paragraphs(10)),
            'visibility' => rand(0, 3),
            'validated' => rand(0, 1),
            'deleted' => rand(0, 1),
            'views' => rand(0, 999),
            'relation_id' => 1,
            'category_id' => 1,
            'resource_type_id' => 1
        ];});
};
