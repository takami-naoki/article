<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'user_id' => 1,
        'short_description' => $faker->text,
        'full_description' => $faker->sentence
    ];
});
