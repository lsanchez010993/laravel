<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id'; // Asegura que Laravel use el ID numérico

    protected $fillable = [
        'nombre_usuario', 'nombre', 'apellido', 'email', 'password', 'avatar', 'token', 'token_recuperacion', 'expiracion_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'token',
        'token_recuperacion',
        'expiracion_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // ⚠️ OPCIONAL: Elimina esta función si quieres que Laravel use 'id' por defecto
    public function getAuthIdentifierName()
    {
        return 'id'; // Cambia 'nombre_usuario' por 'id'
    }
}
