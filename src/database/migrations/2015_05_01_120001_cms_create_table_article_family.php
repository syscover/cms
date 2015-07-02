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
            $table->text('data_351')->nullable();
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