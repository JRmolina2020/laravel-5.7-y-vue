<?php
use Faker\Generator as Faker;
use App\Categoria;
$factory->define(Categoria::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->randomElement(['equipos','audio','controles','VideoJuego']),
        'condicion'=> $faker->numberBetween(1, 0),
    ];
});
