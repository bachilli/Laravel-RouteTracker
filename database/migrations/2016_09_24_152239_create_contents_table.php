<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Executa a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('source_id')->unsigned();
            $table->string('key')->unique();
            $table->string('name');
            $table->enum('type', [ 'GAME', 'CATEGORY' ]);
            $table->enum('status', [ 'ADDED', 'DISCARDED', 'PENDING' ]);
            $table->json('data');
            $table->timestamps();

            $table->foreign('source_id')->references('id')->on('sources')->onDelete('cascade');
        });
    }

    /**
     * Reverte a migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}