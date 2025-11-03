@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-header bg-warning">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>Editar Producto
                    </h3>
                </div>
            </div>

            <!-- Formulario -->
            <div class="card shadow">
                <div class="card-body p-4">
                    <form action="{{ route('productos.update', $producto->id_producto) }}" method="POST" id="formProducto">
                        @csrf
                        @method('PUT')

                        <!-- ID del Producto (solo lectura) -->
                        <div class="alert alert-info mb-4">
                            <strong>ID del Producto:</strong> #{{ $producto->id_producto }}
                        </div>

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label fw-bold">
                                 Nombre <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" 
                                   name="nombre" 
                                   value="{{ old('nombre', $producto->nombre) }}"
                                   placeholder="Ej: Martillo Carpintero"
                                   required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label fw-bold">
                                 Descripción
                            </label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="3"
                                      placeholder="Descripción detallada del producto">{{ old('descripcion', $producto->descripcion) }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label for="precio" class="form-label fw-bold">
                                 Precio <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" 
                                       class="form-control @error('precio') is-invalid @enderror" 
                                       id="precio" 
                                       name="precio" 
                                       value="{{ old('precio', $producto->precio) }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="0.00"
                                       required>
                                @error('precio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">Ingrese el precio en pesos colombianos</small>
                        </div>

                        <!-- Stock -->
                        <div class="mb-3">
                            <label for="stock" class="form-label fw-bold">
                                 Stock <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" 
                                   name="stock" 
                                   value="{{ old('stock', $producto->stock) }}"
                                   min="0"
                                   placeholder="0"
                                   required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Cantidad disponible en inventario</small>
                        </div>

                        <!-- Tipo de Producto -->
                        <div class="mb-4">
                            <label for="id_tipo" class="form-label fw-bold">
                                 Tipo de Producto <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('id_tipo') is-invalid @enderror" 
                                    id="id_tipo" 
                                    name="id_tipo" 
                                    required>
                                <option value="">-- Seleccione --</option>
                                @foreach($tiposProducto as $tipo)
                                    <option value="{{ $tipo->id_tipo }}" 
                                            {{ old('id_tipo', $producto->id_tipo) == $tipo->id_tipo ? 'selected' : '' }}>
                                        {{ $tipo->nombre_tipo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tipo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Información adicional -->
                        <div class="alert alert-secondary">
                            <small>
                                <strong>Creado:</strong> {{ $producto->created_at->format('d/m/Y H:i') }}<br>
                                <strong>Última actualización:</strong> {{ $producto->updated_at->format('d/m/Y H:i') }}
                            </small>
                        </div>

                        <!-- Botones -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning flex-fill">
                                <i class="fas fa-save me-2"></i>Actualizar
                            </button>
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary flex-fill