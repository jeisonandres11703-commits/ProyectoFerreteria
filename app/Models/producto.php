<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'tipo_producto_id', // Sin el guión bajo extra
        'user_id'
    ];

    // Cambiar el nombre de type() a tipoProducto()
    public function tipoProducto()
    {
        return $this->belongsTo(TipoProducto::class, 'tipo_producto_id'); // Corregir: un solo guión bajo y TipoProducto con mayúscula
    }
}