<?php

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'parent_id' => null,
        'name' => $faker->title,
    ];
});
