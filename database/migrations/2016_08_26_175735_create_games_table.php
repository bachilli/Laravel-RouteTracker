<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('type', [ 'FLASH', 'SHOCKWAVE', 'UNITY3D', 'HTML5' ])->nullable();
            $table->enum('embed_type', [ 'INSIDE', 'OUTSIDE' ])->nullable();
            $table->text('embed_src')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->smallInteger('width')->unsigned()->nullable();
            $table->smallInteger('height')->unsigned()->nullable();
            $table->enum('classification', [ 'L', '10', '12', '14', '16', '18' ])->default('L')->nullable();
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
        Schema::drop('games');
    }
}
