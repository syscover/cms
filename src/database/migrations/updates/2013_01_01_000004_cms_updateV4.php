<?php

use Illuminate\Database\Migrations\Migration;


class CmsUpdateV4 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasColumn('013_355_article', 'blank_355'))
		{
			Schema::table('013_355_article', function ($table) {
				$table->string('blank_355')->nullable()->after('link_355');
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