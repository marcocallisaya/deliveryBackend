<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price');
            $table->string('state');
            $table->integer('cliente_id')->unsigned();
            $table->integer('conductor_id')->unsigned();
            $table->integer('administrador_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->engine = 'InnoDB';
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('conductor_id')->references('id')->on('empleados');
            $table->foreign('administrador_id')->references('id')->on('empleados');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedidos');
    }
}
