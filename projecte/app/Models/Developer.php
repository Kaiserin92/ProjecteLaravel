<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    // Añade esta línea para permitir guardar estos datos desde un formulario
    protected $fillable = ['name', 'country', 'founded_year'];
}