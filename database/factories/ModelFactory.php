<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {

    $gender = array(null, 'male', 'female');
    $roles = array('a','s');

    return [
        'firstname' => $faker->firstName($gender),
        'lastname' => $faker->lastName,
        'username' => $faker->userName,
        'password' => app('hash')->make('yourpassword'),
        'role' => $faker->randomElement($roles), // a->admin, s->superadmin
    ];
});

/**
 * Factory definition for model Car.
 */
$factory->define(App\Car::class, function (Faker\Generator $faker) {

    $booleanValue = array(true, false);
    $user_ids = App\User::all()->pluck('id')->toArray();

    return [
        'car_num' => $faker->bothify('CAR###??'),
        'type' => $booleanValue[array_rand($booleanValue, 1)],
        'num_of_seats' => $faker->numberBetween($min = 1, $max = 70),
        'user_id' => $faker->randomElement($user_ids),
    ];
});

/**
 * Factory definition for model Location.
 */
$factory->define(App\Location::class, function (Faker\Generator $faker) {

    $user_ids = App\User::all()->pluck('id')->toArray();

    return [
        'name' => $faker->state,
        'user_id' => $faker->randomElement($user_ids),
    ];
});

/**
 * Factory definition for model Journey.
 */
$factory->define(App\Journey::class, function (Faker\Generator $faker) {

    $user_ids = App\User::all()->pluck('id')->toArray();
    $car_ids = App\Car::all()->pluck('id')->toArray();
    $location_names = App\Location::all()->pluck('name')->toArray();

    return [
        'departure' => $faker->randomElement($location_names),
        'destination' => $faker->randomElement($location_names),
        'driver' => $faker->name,
        'departure_time' => $faker->time($format = 'H:i:s', $max = 'now'),
        'amount' => $faker->numberBetween($min = 1000, $max = 10000),
        'departure_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'user_id' => $faker->randomElement($user_ids),
        'car_id' => $faker->randomElement($car_ids),
    ];
});

/**
 * Factory definition for model Transaction.
 */
$factory->define(App\Transaction::class, function (Faker\Generator $faker) {

    $gender = array(null, 'male', 'female');
    $journey_ids = App\Journey::all()->pluck('id')->toArray();

    return [
        'firstname' => $faker->firstName($gender),
        'lastname' => $faker->lastName,
        'phone' => $faker->e164PhoneNumber,
        'cni' => $faker->randomNumber($nbDigits = 8, $strict = false),
        'seat' => $faker->numberBetween($min = 1, $max = 70),
        'journey_id' => $faker->randomElement($journey_ids),
    ];
});
