<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\TipoProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Mostrar lista de productos
     */
    public function index()
    {
        $productos = Producto::with('tipoProducto') 
            ->activos()
            ->orderBy('nombre')
            ->get();

        return view('productos.index', compact('productos'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        $tiposProducto = TipoProducto::activos()
            ->orderBy('nombre_tipo')
            ->get();

        return view('productos.create', compact('tiposProducto'));
    }

    /**
     * Guardar nuevo producto
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_tipo' => 'required|exists:tipo_producto,id_tipo',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'precio.required' => 'El precio es obligatorio',
            'precio.min' => 'El precio debe ser mayor o igual a 0',
            'stock.required' => 'El stock es obligatorio',
            'stock.min' => 'El stock debe ser mayor o igual a 0',
            'id_tipo.required' => 'Debe seleccionar un tipo de producto',
            'id_tipo.exists' => 'El tipo de producto seleccionado no es válido',
        ]);

        try {
        
            Producto::create($validated);

            return redirect()
                ->route('productos.index')
                ->with('success', ' Producto creado exitosamente');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', ' Error al crear el producto: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $tiposProducto = TipoProducto::activos()
            ->orderBy('nombre_tipo')
            ->get();

        return view('productos.edit', compact('producto', 'tiposProducto'));
    }

    /**
     * Actualizar producto
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:200',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'id_tipo' => 'required|exists:tipo_productos,id_tipo',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'precio.required' => 'El precio es obligatorio',
            'precio.min' => 'El precio debe ser mayor o igual a 0',
            'stock.required' => 'El stock es obligatorio',
            'stock.min' => 'El stock debe ser mayor o igual a 0',
            'id_tipo.required' => 'Debe seleccionar un tipo de producto',
            'id_tipo.exists' => 'El tipo de producto seleccionado no es válido',
        ]);

        try {
            $producto->update($validated);

            return redirect()
                ->route('productos.index')
                ->with('success', ' Producto actualizado exitosamente');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', ' Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar producto (soft delete)
     */
    public function destroy($id)
    {
        try {
            $producto = Producto::findOrFail($id);
            $producto->update(['activo' => false]);

            return redirect()
                ->route('productos.index')
                ->with('success', ' Producto eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', ' Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}
