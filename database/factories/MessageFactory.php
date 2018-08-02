<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'email' => $faker->text(10).'@gmail.com',
        'subject' => $faker->text(50),
        'message' => $faker->text(200),
        'status' => 0
    ];
});
