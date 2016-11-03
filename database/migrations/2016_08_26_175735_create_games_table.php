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
            $table->integer('distributor_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->json('embed')->nullable();
            $table->json('instructions')->nullable();
            $table->json('dimensions')->nullable();
            $table->enum('age_range', [ 'NOT_SPECIFIED', 'L', '10', '12', '14', '16', '18' ]);
            $table->json('thumbnail')->nullable();
            $table->boolean('is_visible');
            $table->timestamp('published_at');
            $table->timestamps();

            // Define a chave ESTRANGEIRA: distributor_id.
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
        Schema::dropIfExists('games');
    }
}