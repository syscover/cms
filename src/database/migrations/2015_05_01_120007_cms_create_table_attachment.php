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
            $table->integer('article_357')->unsigned()->nullable();
            $table->integer('attachment_family_357')->unsigned();
            $table->integer('library_357')->unsigned()->nullable();         // original element library
            $table->integer('sorting_357')->unsigned()->nullable();         // attachment sort
            $table->string('name_357', 510)->nullable();
            $table->string('file_name_357', 1020)->nullable();
            $table->string('mime_354', 255);
            $table->integer('size_354')->unsigned()->nullable();
            $table->tinyInteger('type_357')->unsigned();                    // 1 = image, 2 = file, 3 = video
            $table->string('type_text_357', 50);
            $table->smallInteger('width_357')->unsigned()->nullable();
            $table->smallInteger('height_357')->unsigned()->nullable();
            $table->text('data_357')->nullable();

            $table->foreign('lang_357')->references('id_001')->on('001_001_lang')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('article_357')->references('id_355')->on('013_355_article')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('attachment_family_357')->references('id_353')->on('013_353_attachment_family')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('library_357')->references('id_354')->on('013_354_library')
                ->onDelete('set null')->onUpdate('cascade');

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
