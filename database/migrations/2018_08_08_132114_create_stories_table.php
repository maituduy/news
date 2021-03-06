<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('avatar');
            $table->unsignedInteger('likes')->default(0);
            $table->string('slug')->unique()->nullable();
            $table->text('description')->nullable();
            $table->string('url')->unique()->nullable();
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('manuscript_id')->nullable();
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('view')->default(0);
            $table->string('title')->unique();
            $table->text('content');
            $table->integer('is_active')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('stories');
    }
}
