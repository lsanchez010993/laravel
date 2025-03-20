<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_usuario', 50)->unique();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('token')->nullable();
            $table->string('token_recuperacion', 64)->nullable();
            $table->dateTime('expiracion_token')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('usuarios');
    }
};
