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

$factory->define(Pilaster\Newsletters\Newsletter::class, function (Faker\Generator $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'description' => $faker->paragraph(3),
        'requires_opt_in' => $faker->boolean(75),
    ];
});

$factory->define(Pilaster\Newsletters\Campaign::class, function (Faker\Generator $faker) {
    $sent_at = $faker->randomElement([
        $faker->dateTimeBetween('-10 days', 'now')->getTimestamp(),
        null
    ]);
    return [
        'name' => $faker->company,
        'newsletter_id' => 0,
        'description' => $faker->paragraph(3),
        'sent' => !empty($sent_at),
        'sent_at' => $sent_at,
        'send_at' => $faker->randomElement([
            $faker->dateTimeBetween('now', '+10 days')->getTimestamp(),
            null
        ]),
    ];
});

$factory->define(Pilaster\Newsletters\Subscriber::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
    ];
});

$factory->define(Pilaster\Newsletters\Subscription::class, function (Faker\Generator $faker) {
    $deleted_at = $faker->randomElement([
        $faker->dateTimeBetween('-10 days', 'now')->getTimestamp(),
        null
    ]);
    return [
        'newsletter_id' => 0,
        'subscriber_id' => 0,
        'description' => $faker->paragraphs(3),
        'opted_in' => $faker->boolean(75),
        'opted_in_at' => $faker->dateTimeBetween('-30 days', 'now')->getTimestamp(),
        'deleted_at' => $deleted_at,
    ];
});
