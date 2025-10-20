@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Lista de Productos</h2>

    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <a href="{{ route('productos.create') }}" class="btn btn-primary my-3">Nuevo Producto</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $p)
                <tr>
                    <td>{{ $p->id }}</td>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->tipo }}</td>
                    <td>${{ number_format($p->price, 2) }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $p->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('productos.destroy', $p->id) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
