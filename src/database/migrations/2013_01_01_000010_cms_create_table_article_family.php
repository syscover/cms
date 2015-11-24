<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableArticleFamily extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_351_article_family', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id_351')->unsigned();
            $table->string('name_351', 100);
            $table->tinyInteger('editor_type_351')->unsigned(); //wysiwyg = 1 or contentbuilder = 2
            $table->integer('custom_field_family_351')->unsigned()->nullable();
            $table->text('data_351')->nullable();

            $table->foreign('001_025_field_family', 'fk01_013_351_article_family')->references('id_025')->on('custom_field_family_351')
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
        Schema::drop('013_351_article_family');
    }
}