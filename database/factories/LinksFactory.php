<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Link;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        
        'name' => $faker->name,
        'or_link' => $faker->url,
        'gen_code'=>Str::random(16),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }

    ];
});
