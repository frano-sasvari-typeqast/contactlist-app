<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;
use App\Model\PhoneNumber;

/*
|--------------------------------------------------------------------------
| Phone Factory
|--------------------------------------------------------------------------
*/

$factory->define(PhoneNumber::class, function (Faker $faker) {
    $contact = DB::table('contact')->inRandomOrder()->first(['id']);

    return [
        'contact_id' => $contact->id,
        'label' => mb_ucfirst($faker->word),
        'number' => $faker->phoneNumber,
    ];
});
