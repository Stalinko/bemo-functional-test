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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->integer('position');
            $table->unsignedBigInteger('column_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('column_id')->references('id')->on('columns');
            $table->index('position'); //for fast sorting
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cards');
    }
};
