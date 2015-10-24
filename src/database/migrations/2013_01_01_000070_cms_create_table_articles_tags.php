<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableArticlesTags extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('013_359_articles_tags', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('article_359')->unsigned();
            $table->integer('tag_359')->unsigned();

            $table->primary(['article_359', 'tag_359']);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('013_359_articles_tags');
	}
}