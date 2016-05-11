<?php

use Illuminate\Database\Migrations\Migration;


class CmsUpdateV1 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasColumn('013_351_article_family', 'custom_field_group_351'))
		{
			Schema::table('013_351_article_family', function ($table) {
				$table->integer('custom_field_group_351')->unsigned()->nullable()->after('editor_type_351');

				$table->foreign('custom_field_group_351', 'fk01_013_351_article_family')->references('id_025')->on('001_025_field_group')
					->onDelete('restrict')->onUpdate('cascade');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}