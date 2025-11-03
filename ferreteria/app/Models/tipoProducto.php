<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_producto';
    protected $primaryKey = 'id_tipo';

    protected $fillable = [
        'nombre_tipo',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relación: Un tipo tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_tipo', 'id_tipo');
    }

    // Scope: Solo tipos activos
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }
}
