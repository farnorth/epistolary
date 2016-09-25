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

$factory->define(Pilaster\Epistolary\MailingList::class, function (Faker\Generator $faker) {
    $name = $faker->bs;
    return [
        'name' => $name,
        'slug' => str_slug($name),
        'from_name' => $faker->name,
        'from_email' => $faker->email,
        'description' => $faker->paragraph(3),
        'requires_opt_in' => $faker->boolean(75),
    ];
});

$factory->define(Pilaster\Epistolary\Campaign::class, function (Faker\Generator $faker) {
    $sent_at = $faker->randomElement([
        $faker->dateTimeBetween('-10 days', 'now')->getTimestamp(),
        null
    ]);
    return [
        'name' => $faker->bs,
        'subject' => $faker->bs,
        'list_id' => $faker->numberBetween(1, 5),
        'description' => $faker->paragraph(3),
        'is_sent' => !empty($sent_at),
        'sent_at' => $sent_at,
        'is_scheduled' => $faker->boolean(20),
        'scheduled_for' => $faker->randomElement([
            $faker->dateTimeBetween('now', '+10 days')->getTimestamp(),
            null
        ]),
    ];
});

$factory->define(Pilaster\Epistolary\Subscriber::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
    ];
});

$factory->define(Pilaster\Epistolary\Subscription::class, function (Faker\Generator $faker) {
    $deleted_at = $faker->randomElement([
        $faker->dateTimeBetween('-10 days', 'now')->getTimestamp(),
        null
    ]);
    return [
        'list_id' => $faker->numberBetween(1, 5),
        'subscriber_id' => 1,
        'opted_in' => $faker->boolean(75),
        'opted_in_at' => $faker->dateTimeBetween('-30 days', 'now')->getTimestamp(),
        'deleted_at' => $deleted_at,
    ];
});
