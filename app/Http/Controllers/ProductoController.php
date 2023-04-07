<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producto = Producto::where('estado',1)->get();
        return response()->json([$producto,'message' => 'Lista de Productos.']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'foto_producto' => 'required|string',
            'id_marcas' => 'required|integer',
            'id_categorias' => 'required|integer',
            'id_proveedors' => 'required|integer'
        ]);

        $producto = new Producto([
            'nombre_producto' => $validData['nombre_producto'],
            'cantidad' => $validData['cantidad'],
            'foto_producto' => $validData['foto_producto'],
            'id_marcas' => $validData['id_marcas'],
            'id_categorias' => $validData['id_categorias'],
            'id_proveedors' => $validData['id_proveedors'],
            'estado' => 1
        ]);

        $producto->save();

        return response()->json([$producto,'message' => 'Producto Añadido Correctamente.',200]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        if (is_null($producto)) {
            return response()->json(['message' => 'Producto No Encontrado.',404]);
        }

        return response()->json([$producto,'message' => 'Producto Encontrado.',200]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (is_null($producto)) {
            return response()->json(['message' => 'Producto No Encontrado',404]);
        }

        $validData = $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'foto_producto' => 'required|string',
            'id_marcas' => 'required|integer',
            'id_categorias' => 'required|integer',
            'id_proveedors' => 'required|integer'
        ]);

        $producto->save([
            'nombre_producto' => $validData['nombre_producto'],
            'cantidad' => $validData['cantidad'],
            'foto_producto' => $validData['foto_producto'],
            'id_marcas' => $validData['id_marcas'],
            'id_categorias' => $validData['id_categorias'],
            'id_proveedors' => $validData['id_proveedors'],
            'estado' => 1
        ]);


        $producto->save();

        return response()->json($producto,['message' => 'Producto Actualizado.',200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);

        if (is_null($producto)) {
            return response()->json(['message' => 'Producto No Encontrado',404]);
        }

        $producto->estado = 0;
        $producto->save();

        return response()->json([$producto,'message' => 'Producto Eliminado Correctamente.']);
    }
}
