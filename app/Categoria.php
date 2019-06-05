<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['nombre', 'condicion'];

    public function productos()
    {
        return $this->hasMany('App\Producto');
    }
}
