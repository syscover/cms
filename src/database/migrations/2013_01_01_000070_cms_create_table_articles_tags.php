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
			
            $table->integer('article_id_359')->unsigned();
            $table->integer('tag_id_359')->unsigned();

            $table->primary(['article_id_359', 'tag_id_359'], 'pk01_013_359_articles_tags');
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