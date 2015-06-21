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
            $table->integer('image_width_351')->unsigned();
            $table->integer('image_height_351')->unsigned();
            $table->tinyInteger('editor_type_351')->unsigned(); //text = 1, wysiwyg = 2 or contentbuilder = 3
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
