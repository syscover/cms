<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableArticlesCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('013_356_articles_categories', function(Blueprint $table){
            $table->engine = 'InnoDB';
			
            $table->integer('article_id_356')->unsigned();
            $table->integer('category_id_356')->unsigned();

            $table->primary(['article_id_356', 'category_id_356'], 'pk01_013_356_articles_categories');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('013_356_articles_categories');
	}
}