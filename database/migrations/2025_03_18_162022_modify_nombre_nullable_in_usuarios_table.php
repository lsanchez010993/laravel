<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('nombre')->nullable()->change();
            $table->string('apellido')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('nombre')->nullable(false)->change();
            $table->string('apellido')->nullable(false)->change();
        });
    }
};
