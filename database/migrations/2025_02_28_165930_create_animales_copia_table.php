<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('animales_copia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comun', 55);
            $table->string('nombre_cientifico', 55);
            $table->text('descripcion');
            $table->string('ruta_imagen', 255)->nullable();
            $table->foreignId('usuario_id')->nullable()->constrained('usuarios')->onDelete('set null');
            $table->timestamp('fecha_insercion')->useCurrent();
            $table->boolean('es_mamifero');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('animales_copia');
    }
};
