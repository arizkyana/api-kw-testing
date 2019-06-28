<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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
    'email' => $faker->email,
    ];
});

$factory->define(App\Template::class, function(Faker\Generator $faker){
    return [
    'name' => $faker->name,
    'checklist' => json_encode([
    'description' => $faker->text,
    'due_interval' => $faker->numberBetween(1,3),
    'due_unit' => 'minute'
    ])
    ];
});

$factory->define(App\TemplateItem::class, function(Faker\Generator $faker){
    return [
    'description' => $faker->text,
    'urgency' => 3,
    'due_interval' => 5,
    'due_unit' => 'minute',
    'template_id' => 1
    ];
});

$factory->define(App\TemplateChecklist::class, function(Faker\Generator $faker){
    return [
    'description' => $faker->text,
    'due_interval' => $faker->numberBetween(1,3),
    'due_unit' => 'minute',
    'template_id' => 1
    ];
});

$factory->define(App\User::class, function(Faker\Generator $faker){
    return [
    'name' => $faker->name,
    'email' => $faker->unique->safeEmail(),
    'api_token' => Hash::make('api-token'),
    'password' => Hash::make('12341234')
    ];
});