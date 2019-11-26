<?php

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'title' => $faker->title,
        'body' => $faker->text,
    ];
});
