<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProducto extends Model
{
    use HasFactory;

    protected $table = 'tipo_productos'; // Ajusta según tu tabla

    protected $fillable = [
        'name',
        'description',
    ];
}


