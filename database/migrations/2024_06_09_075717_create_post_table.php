<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void 
     */
    public function up()
    {
        Schema::create('t_post', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('flag')->default('1');
            $table->Integer('user_id');
            $table->string('category');
            $table->string('title');
            $table->longText('content');
            $table->string('image')->nullable();
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
        Schema::dropIfExists('t_post');
    }
};
