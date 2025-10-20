@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Tipos de Productos</h2>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tiposProducto.create') }}" class="btn btn-primary my-3">Nuevo Tipo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tiposProducto as $t)
                <tr>
                    <td>{{ $t->id }}</td>
                    <td>{{ $t->name }}</td>
                    <td>{{ $t->description }}</td>
                    <td>
                        <a href="{{ route('tiposProducto.edit', $t->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('tiposProducto.destroy', $t->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar tipo de producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
