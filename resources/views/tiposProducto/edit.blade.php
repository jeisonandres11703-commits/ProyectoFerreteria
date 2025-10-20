@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Tipo de Producto</h2>

    <form action="{{ route('product-types.update', $tipoProducto->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ $tipoProducto->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control">{{ $tipoProducto->description }}</textarea>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('product-types.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
