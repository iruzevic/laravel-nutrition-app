<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('brand');
            $table->integer('unit');
            $table->integer('calories');
            $table->float('carb');
            $table->float('protein');
            $table->float('fat');
            $table->float('sugar');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('nutrients_type_id')->unsigned();
            $table->foreign('nutrients_type_id')->references('id')->on('nutrients_type');
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
        Schema::dropIfExists('nutrients');
    }
}
