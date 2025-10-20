@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Editar Producto</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" name="price" value="{{ $product->price }}" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo de Producto</label>
            <select name="product_type_id" class="form-control" required>
                @foreach ($types as $t)
                    <option value="{{ $t->id }}" {{ $product->product_type_id == $t->id ? 'selected' : '' }}>
                        {{ $t->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
