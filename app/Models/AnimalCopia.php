<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalCopia extends Model {
    use HasFactory;

    protected $table = 'animales_copia';
    protected $fillable = [
        'nombre_comun', 'nombre_cientifico', 'descripcion',
        'ruta_imagen', 'usuario_id', 'es_mamifero'
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}