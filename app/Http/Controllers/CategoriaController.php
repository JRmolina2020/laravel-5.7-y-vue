<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = Categoria::orderBy('id', 'DESC')->get();
        return $categoria;
    }

    public function store(Request $request)
    {
        $categoria = new Categoria();
        //Categoria::create($request->all());
        $categoria->nombre = $request->nombre;
        $categoria->save();
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::find($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
    }
    public function activar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = '1';
        $categoria->save();
    }
    public function desactivar($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = '0';
        $categoria->save();
    }
}
