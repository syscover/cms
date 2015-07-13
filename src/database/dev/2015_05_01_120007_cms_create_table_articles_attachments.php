<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableArticlesAttachments extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_357_articles_attachments', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id_357');
            $table->string('lang_357', 2);
            $table->string('name_357', 510);
            $table->string('file_357', 1020);
            $table->string('mime_354', 255);
            $table->integer('size_354');
            $table->smallInteger('width_357')->unsigned()->nullable();
            $table->smallInteger('height_357')->unsigned()->nullable();
            $table->text('data_357')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_357_articles_attachments');
    }
}
