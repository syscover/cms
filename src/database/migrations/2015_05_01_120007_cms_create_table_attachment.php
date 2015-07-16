<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableAttachment extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_357_attachment', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id_357')->unsigned();
            $table->string('lang_357', 2);
            $table->integer('article_357')->unsigned();
            $table->integer('file_357')->unsigned();
            $table->string('name_357', 510);
            $table->string('file_name_357', 1020);
            $table->string('mime_354', 255);
            $table->integer('size_354')->unsigned();
            $table->boolean('is_image_357');
            $table->smallInteger('width_357')->unsigned()->nullable();
            $table->smallInteger('height_357')->unsigned()->nullable();
            $table->text('data_357')->nullable();

            $table->foreign('lang_357')->references('id_001')->on('001_001_lang')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('article_357')->references('id_355')->on('013_355_article')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['id_357', 'lang_357']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_357_attachment');
    }
}
