<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('ingredients');
            $table->text('preparation');
            $table->string('image');
            $table->foreignId('user_id')->references('id')->on('users'); // Usuario que crea la receta.
            $table->foreignId('category_id')->references('id')->on('categories'); // Categoría a la cual pertenece la receta.
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
        Schema::dropIfExists('recetas');
    }
}
