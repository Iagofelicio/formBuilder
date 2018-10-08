<?php

use Faker\Generator as Faker;

$factory->define(FormBuilder\Models\Answer::class, function (Faker $faker) {
    return [
        'answer' => $faker->text(500)
    ];
});
