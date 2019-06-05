<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::orderBy('id', 'DESC')->get();
        return $categoria;
    }

    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = new Categoria();
        //Categoria::create($request->all());
        $categoria->nombre = $request->nombre;
        $categoria->save();
    }

    public function update(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::find($request->id);
        $categoria->nombre = $request->nombre;
        $categoria->condicion = '1';
        $categoria->save();
    }

    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
    }
    public function activar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = '1';
        $categoria->save();
    }
    public function desactivar(Request $request, $id)
    {
        if (!$request->ajax()) return redirect('/');
        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = '0';
        $categoria->save();
    }
}
