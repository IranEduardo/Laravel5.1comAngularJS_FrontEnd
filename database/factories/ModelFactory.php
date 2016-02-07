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

$factory->define(CodeProject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});


$factory->define(CodeProject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs'     => $faker->sentence
    ];
});

$factory->define(CodeProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
            'owner_id'    => $faker->numberBetween(1,1),
            'client_id'   => $faker->numberBetween(1,10),
            'name'        => $faker->word,
            'description' => $faker->paragraph,
            'progress'    => $faker->numberBetween(1,10),
            'status'      => $faker->numberBetween(1,10),
            'due_date'    => $faker->date()
    ];
});

$factory->define(CodeProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id'    => $faker->numberBetween(1,1),
        'client_id'   => $faker->numberBetween(1,10),
        'name'        => $faker->word,
        'description' => $faker->paragraph,
        'progress'    => $faker->numberBetween(1,10),
        'status'      => $faker->numberBetween(1,10),
        'due_date'    => $faker->date()
    ];
});

$factory->define(CodeProject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
            'project_id' => $faker->numberBetween(1,10),
            'title'      => $faker->word,
            'note'       => $faker->paragraph()
    ];
});

$factory->define(CodeProject\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
            'name'        => $faker->word,
            'project_id'  => $faker->numberBetween(1,10),
            'start_date'  => $faker->date(),
            'due_date'    => $faker->date(),
            'status'      => $faker->numberBetween(1,10),
    ];
});

$factory->define(CodeProject\Entities\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        'project_id'  => $faker->numberBetween(1,10),
        'user_id'     => $faker->numberBetween(1,10)
    ];
});





