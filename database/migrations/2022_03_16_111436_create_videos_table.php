<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('video', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->bigInteger('length')->nullable();
            $table->date('release_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('trending')->default(false);
            $table->bigInteger('category_id')->unsigned();
            $table->boolean('status')->default(true);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
