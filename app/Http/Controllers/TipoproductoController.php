<?php

namespace App\Http\Controllers;

use App\Models\TipoProducto; // Corregido: Primera letra mayúscula
use Illuminate\Http\Request;

class TipoproductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tiposProducto = TipoProducto::all();
        return view('tiposProducto.index', compact('tiposProducto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiposproducto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        TipoProducto::create($request->all());

        return redirect()->route('tiposProducto.index') // Corregido
                         ->with('success', 'Tipo de producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TipoProducto $tipoProducto)
    {
        return view('tiposproductos.show', compact('tipoProducto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TipoProducto $tipoProducto)
    {
        return view('tiposproductos.edit', compact('tipoProducto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TipoProducto $tipoProducto)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $tipoProducto->update($request->all());

        return redirect()->route('tiposProducto.index')
                         ->with('success', 'Tipo de producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TipoProducto $tipoProducto)
    {
        $tipoProducto->delete();

        return redirect()->route('tiposProducto.index')
                         ->with('success', 'Tipo de producto eliminado exitosamente.');
    }
}