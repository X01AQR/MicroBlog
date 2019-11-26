<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->email,
        'password' => app('hash')->make($faker->password)
    ];
});
