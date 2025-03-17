<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model {
    use HasFactory;

    protected $table = 'animales';
    protected $fillable = [
        'nombre_comun', 'nombre_cientifico', 'descripcion',
        'ruta_imagen', 'usuario_id', 'es_mamifero', 'publicado'
    ];

    public function usuario() {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
