<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignStoryTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('story_tag', function (Blueprint $table) {
            //
            $table->foreign('story_id')->references('id')->on('stories');
            $table->foreign('tag_id')->references('id')->on('tags');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('story_tag', function (Blueprint $table) {
            //
            $table->dropForeign(['story_id','tag_id']);
        });
    }
}
