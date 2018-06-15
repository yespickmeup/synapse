<?php

use Faker\Generator as Faker;

$factory->define(App\Setting::class, function (Faker $faker) {
    return [
        'business_name' => 'SynSofTech',
        'address' => $faker->text(15),
        'phone_number' => ' +1 5589 55488 55',
        'email' => 'contact@synapse.com',
        'slogan' => 'Integrating Business with Technology',
        'about_title' => $faker->text(15),
        'about_description' => $faker->text(30),
        'services_description' => $faker->text(35),
        'clients_description' => $faker->text(35),
        'portfolio_description' => $faker->text(35),
        'testimonials_description' => $faker->text(35),
        'call_to_action_description' => $faker->text(35),
        'contact_us_description' => $faker->text(35)
    ];
});
