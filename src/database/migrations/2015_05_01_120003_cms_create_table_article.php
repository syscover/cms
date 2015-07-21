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
        Schema::create('013_355_article', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id_355')->unsigned();
            $table->string('lang_355', 2);
            $table->integer('author_355')->unsigned();
            $table->string('section_355', 30);
            $table->integer('family_355')->unsigned()->nullable(); // element to set default article configuration
            $table->tinyInteger('status_355')->unsigned();  // 0 = draft 1 = publish
            $table->integer('publish_355')->unsigned();     // date when will be publish
            $table->string('publish_text_355', 25);         // date publish in text format
            $table->integer('date_355')->unsigned(); // date of article
            $table->string('title_355', 510);
            $table->string('slug_355', 255)->nullable();
            $table->integer('sorting_355')->unsigned(); // article sort
            $table->string('tags_355', 1020); // article tags
            $table->longText('article_355');

            // extract property inside data_355
            // SEO properties inside data_355
            $table->text('data_355')->nullable();

            $table->foreign('lang_355')->references('id_001')->on('001_001_lang')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('author_355')->references('id_010')->on('001_010_user')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('section_355')->references('id_350')->on('013_350_section')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('family_355')->references('id_351')->on('013_351_article_family')
                ->onDelete('restrict')->onUpdate('cascade');

            $table->primary(['id_355', 'lang_355']);
            $table->unique(['lang_355','slug_355']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_355_article');
    }

}
