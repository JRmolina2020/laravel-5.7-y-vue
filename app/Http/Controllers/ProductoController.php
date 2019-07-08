<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class ProductoController extends Controller
{

    public function index()
    {
        $producto = Producto::join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->select(
                'productos.id',
                'productos.codigo',
                'productos.nombre',
                'productos.precio_venta',
                'productos.stock',
                'productos.descripcion',
                'productos.imagen',
                'categorias.nombre as nombre_categoria',
                'categorias.id as categoria_id',
                'productos.condicion'
            )->orderBy('productos.id', 'desc')->get();
        return $producto;
    }
    public function store(Request $request)
    {
    if (!$request->ajax()) return redirect('/');
    $producto = new Producto;
    $producto->create($request->all());
    }
    public function update(Request $request, $id)
    {
    if (!$request->ajax()) return redirect('/');
        $producto = Producto::find($request->id);
        $producto->categoria_id=$request->categoria_id;
        $producto->codigo = $request->codigo;
        $producto->nombre = $request->nombre;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->precio_venta = $request->precio_venta;
        $producto->condicion = '1';
        $producto->save();
    }
    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($id);
        $producto->delete();
    }
    public function activar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($id);
        $producto->condicion = '1';
        $producto->save();
    }
    public function desactivar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $producto = Producto::findOrFail($id);
        $producto->condicion = '0';
        $producto->save();
    }
}
