<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Campos de la tabla productos
    protected $fillable = ['nombre', 'descripcion', 'precio', 'stock','estado'];
}
