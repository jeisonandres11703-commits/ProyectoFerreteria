@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Nuevo Tipo de Producto</h2>

    <form action="{{ route('tiposProducto.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Guardar</button>
        <a href="{{ route('tiposProducto.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
