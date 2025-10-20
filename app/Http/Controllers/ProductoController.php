<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\tipoProducto; // Primera letra mayúscula
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('tipoProducto')->get(); // tipoProducto en camelCase
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $types = tipoProducto::all(); // Primera letra mayúscula
        return view('productos.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')
                         ->with('success', 'Producto creado exitosamente.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $types = tipoProducto::all();
        return view('productos.edit', compact('producto', 'types'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')
                         ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')
                         ->with('success', 'Producto eliminado exitosamente.');
    }
}