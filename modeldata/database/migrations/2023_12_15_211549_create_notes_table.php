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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('description', 255)->nullable();
            $table->date('deadline');
            $table->boolean('done')->default(false);
            /* $table->integer('example');
            $table->integer('example')->unsigned();
            $table->unsignedInteger('example');
            $table->bigInteger('example');
            $table->unsignedBigInteger('example');
            $table->text('example');
            $table->float('example');
            $table->double('example');
            $table->enum('state', ['Draf', 'PUBLISHED', 'DELETED']); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
