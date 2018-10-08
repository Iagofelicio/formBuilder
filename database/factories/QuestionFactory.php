<?php

use Faker\Generator as Faker;

$factory->define(FormBuilder\Models\Question::class, function (Faker $faker) {
    return [
        'title' => $faker->colorName,
        'description' => $faker->text(400),
        'type' => $faker->title
    ];
});
