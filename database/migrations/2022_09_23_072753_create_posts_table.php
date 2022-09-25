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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->text('body')->nullable();
            $table->mediumText('excerpt')->nullable();
            $table->tinytext('thumbnail')->nullable();
            $table->string('author_id');
            $table->timestamp('published_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
