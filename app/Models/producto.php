<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'id_tipo',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',
        'activo' => 'boolean',
    ];

    // Relación: Un producto pertenece a un tipo
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'id_tipo', 'id_tipo');
    }

    // Scope: Solo productos activos
    public function scopeActivos($query)
    {
        return $query->where('activo', true);
    }

    // Accessor: Precio formateado
    public function getPrecioFormateadoAttribute()
    {
        return '$' . number_format($this->precio, 0, ',', '.');
    }


}                      
    

  
