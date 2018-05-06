<?php

use Faker\Generator as Faker;
use App\Model\Phone;
use App\Model\Contact;

/*
|--------------------------------------------------------------------------
| Phone Factory
|--------------------------------------------------------------------------
*/

$contactIds = Contact::all()->pluck('id')->toArray();

$factory->define(Phone::class, function (Faker $faker) use ($contactIds) {
    return [
        'contact_id' => $faker->randomElement($contactIds),
        'label' => $faker->word,
        'number' => $faker->phoneNumber,
    ];
});
