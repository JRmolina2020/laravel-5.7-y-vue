<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'categoria_id', 'codigo', 'nombre', 'precio_venta',
        'stock', 'descripcion', 'condicion', 'imagen'
    ];
    public function categoria()
    {
        return $this->belongsTo('App\Categoria');
    }
}
