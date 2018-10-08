<?php

use Faker\Generator as Faker;

$factory->define(FormBuilder\Models\Role::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
        'description' => $faker->text(200)
    ];
});
