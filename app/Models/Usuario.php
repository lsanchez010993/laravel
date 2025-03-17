<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable {
    use HasFactory;

    protected $table = 'usuarios';
    protected $fillable = [
        'nombre_usuario', 'nombre', 'apellido', 'email', 'password',
        'avatar', 'token', 'token_recuperacion', 'expiracion_token'
    ];

    protected $hidden = ['password'];

    public function animales() {
        return $this->hasMany(Animal::class, 'usuario_id');
    }

    public function animalesCopia() {
        return $this->hasMany(AnimalCopia::class, 'usuario_id');
    }
}
