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
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Actor::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
    ];
});

$factory->define(App\Actor::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
    ];
});

$factory->define(App\Country::class, function (Faker\Generator $faker) {
    return [
        'country' => $faker->country,
    ];
});

$factory->define(App\City::class, function (Faker\Generator $faker) {
    return [
        'city' => $faker->city,
    ];
});
$factory->define(App\Address::class, function (Faker\Generator $faker) {
    return [
        'address1' => $faker->streetAddress,
        'address2' => $faker->streetAddress,
        'district' => $faker->state,
        'phone' => $faker->phoneNumber,
        'postalCode' => $faker->postcode,
    ];
});

$factory->define(App\Film::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'releaseYear' => $faker->year,
        'rentalDuration' => $faker->randomDigit,
        'rentalRate' => $faker->randomFloat,
        'length' => $faker->randomDigit,
        'replacementCost' => $faker->randomFloat,
        'rating' => $faker->randomLetter,
    ];
});

$factory->define(App\Language::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Store::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});
