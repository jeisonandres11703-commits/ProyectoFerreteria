@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            <i class="fas fa-box me-2"></i>Gestión de Productos
                        </h3>
                        <a href="{{ route('productos.create') }}" class="btn btn-light">
                            <i class="fas fa-plus me-2"></i>Nuevo Producto
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <!-- Tabla de Productos -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"> Productos Registrados</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="tablaProductos">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Stock</th>
                                    <th>Tipo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productos as $producto)
                                <tr>
                                    <td>{{ $producto->id_producto }}</td>
                                    <td><strong>{{ $producto->nombre }}</strong></td>
                                    <td>{{ Str::limit($producto->descripcion, 50) }}</td>
                                    <td class="text-end">
                                        <span class="badge bg-success">
                                            {{ $producto->precio_formateado }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge {{ $producto->stock < 10 ? 'bg-danger' : 'bg-info' }}">
                                            {{ $producto->stock }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ $producto->tipoProducto->nombre_tipo }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('productos.edit', $producto->id_producto) }}" 
                                               class="btn btn-sm btn-warning"
                                               title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('productos.destroy', $producto->id_producto) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('¿Está seguro de eliminar este producto?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger"
                                                        title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No hay productos registrados</p>
                                        <a href="{{ route('productos.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus me-2"></i>Crear Primer Producto
                                        </a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $('#tablaProductos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        order: [[1, 'asc']]
    });
});
</script>
@endpush
