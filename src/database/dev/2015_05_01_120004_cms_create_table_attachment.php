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
        Schema::create('013_354_attachment', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id_354')->unsigned();

            $table->integer('article_354')->unsigned();

            $table->integer('family_354')->unsigned()->nullable();
            $table->string('mime', 255);

            //$table->string('lang_354',2); //?? to data
            $table->boolean('multi_lang_354')->default(false); // check if this attachment is multi language
            $table->string('name_354', 510); //?? attachment name to get a reference

            //$table->string('attachment_uri_354', 510); // attachment uri
            //$table->string('attachment_url_354', 1020); // attachment url

            $table->integer('sorting_354')->unsigned(); // attachment sort


            // title property inside data_354
            // attachment_uri property inside data_354
            // attachment_url property inside data_354
            $table->text('data_354')->nullable();

            $table->primary(['id_354', 'lang_354']);
            //$table->foreign('lang_354')->references('id_001')->on('001_001_lang')
            //    ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('article_354')->references('id_355')->on('013_355_article')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('family_354')->references('id_353')->on('013_353_attachment_family')
                ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_354_attachment');
    }
}
