<?php

use Faker\Generator as Faker;
use App\Producto;

$factory->define(Producto::class, function (Faker $faker) {
    return [
        'categoria_id' => rand(1, 20),
        'codigo'  => 'FJFF33',
        'nombre'  => $faker->name,
        'precio_venta' => '200000',
        'stock' => rand(1, 22),
        'descripcion' => $faker->sentence(8),
        'condicion' => $faker->numberBetween(1, 0),
        'imagen' => 'https://www.dimm.com.uy/imgs/productos/productos35_30764.jpg'
    ];
});
