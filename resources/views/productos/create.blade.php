@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Nuevo Producto</h2>

    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo de Producto</label>
            <select name="tipoProducto_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach ($types as $t)
                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
