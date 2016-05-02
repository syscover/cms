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
			
            $table->integer('article_356')->unsigned();
            $table->integer('category_356')->unsigned();

            $table->primary(['article_356', 'category_356']);
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