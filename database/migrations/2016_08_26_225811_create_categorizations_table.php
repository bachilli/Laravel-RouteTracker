<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorizationsTable extends Migration
{
    /**
     * Executa a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorizations', function (Blueprint $table) {
            $table->integer('game_id')->unsigned();
            $table->integer('tag_id')->unsigned();
            $table->timestamps();

            // Define as chaves PRIMÁRIAS: game_id, tag_id.
            $table->primary([ 'game_id', 'tag_id' ]);

            // Define as chaves ESTRANGEIRAS: game_id, tag_id.
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverte a migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorizations');
    }
}