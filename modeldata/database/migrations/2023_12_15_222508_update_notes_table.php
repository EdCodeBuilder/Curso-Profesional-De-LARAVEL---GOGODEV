<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schemma::table('notes', function(Blueprint $table){
            $table->string('author'); // añade una nueva columna
            $table->dropColumn(['deadline']); // elimina las columnas mencionadas en la lista
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropColumn(['author']); // al revertir la migración, eliminamos la adicion de la columna creada aquí
    }
};
