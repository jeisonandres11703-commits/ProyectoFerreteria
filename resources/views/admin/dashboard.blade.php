@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group">
                <a href="{{ route('productos.index') }}" class="list-group-item list-group-item-action">Productos</a>
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">Cerrar sesión</button>
                </form>
            </div>
        </div>

        <div class="col-md-9">
            <h2>Bienvenido, {{ session('usuario.nombre') }}</h2>
            <p>Selecciona una opción del menú lateral para gestionar el sistema.</p>
        </div>
    </div>
</div>
@endsection
