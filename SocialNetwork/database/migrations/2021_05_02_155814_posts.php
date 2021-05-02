<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('posts', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('user_id');
           $table->foreign('user_id')->references('id')->on('users');
            $table->text('post_content');
            $table->double('likes')->default(0);
            $table->double('dislikes')->default(0);
            $table->double('size');
            $table->string('image_dir')->nullable();
            $table->string('video_dir')->nullable();
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
        //
    }
}
