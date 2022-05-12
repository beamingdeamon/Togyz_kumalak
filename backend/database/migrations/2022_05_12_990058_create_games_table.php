<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('opponent_id')->nullable();
            $table->foreign('opponent_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_column_id');
            $table->foreign('user_column_id')->references('id')->on('user_columns')->onDelete('cascade');
            $table->unsignedBigInteger('opponent_column_id');
            $table->foreign('opponent_column_id')->references('id')->on('opponent_columns')->onDelete('cascade');
            $table->text('game_code');
            $table->integer('move');
            $table->string('game_status')->default('Ожидайте подключения противника');

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
        Schema::dropIfExists('games');
    }
};
