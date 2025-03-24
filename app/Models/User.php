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
    protected $primaryKey = 'id'; 

    protected $fillable = [
        'nombre_usuario', 'nombre', 'apellido', 'email', 'password', 'avatar', 'token', 'token_recuperacion', 'expiracion_token', 'provider', 'provider_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'token',
        'token_recuperacion',
        'expiracion_token',
        'provider',
        'provider_id',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    public function getAuthIdentifierName()
    {
        return 'id'; 
    }
}
