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
        Schema::create('user_columns', function (Blueprint $table) {
            $table->id();
            $table->integer('first_column')->default('9');
            $table->integer('second_column')->default('9');
            $table->integer('three_column')->default('9');
            $table->integer('four_column')->default('9');
            $table->integer('five_column')->default('9');
            $table->integer('six_column')->default('9');
            $table->integer('seven_column')->default('9');
            $table->integer('eight_column')->default('9');
            $table->integer('nine_column')->default('9');
            $table->integer('kazan')->default('0');
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
        Schema::dropIfExists('user_columns');
    }
};
