<?php

use Faker\Generator as Faker;
use App\Model\Contact;

/*
|--------------------------------------------------------------------------
| Contact Factory
|--------------------------------------------------------------------------
*/

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'is_favorite' => ($faker->boolean(25) ? 1 : null), // 25% chance of true
    ];
});
