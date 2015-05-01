<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableArticlesAttachments extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
        Schema::create('010_209_fichas_sectores', function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->integer('ficha_209')->unsigned();
            $table->integer('sector_209')->unsigned();

            $table->primary(['ficha_209', 'sector_209'], 'pk_fichas_sectores');

            $table->foreign('ficha_209')->references('id_206')->on('010_206_ficha')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sector_209')->references('id_202')->on('010_202_sector')
                ->onDelete('cascade')->onUpdate('cascade');
        });
        */
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        //Schema::drop('010_209_fichas_sectores');
	}

}
