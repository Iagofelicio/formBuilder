<?php

use Faker\Generator as Faker;

$factory->define(FormBuilder\Models\Form::class, function (Faker $faker) {
    return [
        'title' => $faker->text(100),
        'description' => $faker->text(400)
    ];
});
