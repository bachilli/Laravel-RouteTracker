<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Executa a migração.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->json('embed')->nullable();
            $table->json('instructions')->nullable();
            $table->json('dimensions')->nullable();
            $table->enum('age_range', [ 'L', '10', '12', '14', '16', '18' ])->nullable();
            $table->json('file')->nullable();
            $table->json('thumbnail')->nullable();
            $table->boolean('is_visible')->default(0);
            $table->dateTime('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverte a migração.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
}