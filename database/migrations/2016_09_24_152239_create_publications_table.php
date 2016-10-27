<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
    /**
     * Executa a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('distributor_id')->unsigned();
            $table->string('key')->unique();
            $table->string('name');
            $table->enum('type', [ 'GAME', 'TAG' ]);
            $table->enum('status', [ 'ADDED', 'DISCARDED', 'PENDING' ]);
            $table->json('data');
            $table->timestamps();

            $table->foreign('distributor_id')->references('id')->on('distributors')->onDelete('cascade');
        });
    }

    /**
     * Reverte a migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('publications');
    }
}