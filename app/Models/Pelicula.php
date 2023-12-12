<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    public function salas()
    {
        return $this->belongsToMany(Sala::class)->as('proyecciones');
    }
}
