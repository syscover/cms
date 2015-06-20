<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableArticle extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_353_article', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id_353')->unsigned();
            $table->string('lang_353',2);

            $table->integer('section_353')->unsigned();
            $table->integer('family_353')->unsigned()->nullable();  // element to set default article configuration
            // category multiselect

            $table->integer('publish_353')->unsigned(); // date when will be publish
            $table->tinyInteger('status_353')->unsigned();  // 1 = draft 2 = publish
            $table->integer('author_353')->unsigned();
            $table->integer('date_353')->unsigned(); // date of article
            
            //SEO??

            $table->string('title_353', 510);
            $table->string('slug_353', 510);
            $table->integer('sorting_353')->unsigned(); // article sort
            $table->string('tags_353', 255); // article tags

            $table->text('extract_353');
            $table->longText('article_353');

            $table->text('data_353')->nullable();

            $table->primary(['id_353', 'lang_353']);
            $table->foreign('lang_353')->references('id_001')->on('001_001_lang')
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
        Schema::drop('013_353_article');
    }

}
