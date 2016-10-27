<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Executa a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->json('thumbnail')->nullable();
            $table->boolean('is_visible')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });

        //
        // Tabela auxiliar para associar os JOGOS as TAGS.
        //
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
        Schema::dropIfExists('tags');
    }
}