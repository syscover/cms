<?php

use Illuminate\Database\Migrations\Migration;


class CmsUpdateV3 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasColumn('013_355_article', 'link_355'))
		{
			Schema::table('013_355_article', function ($table) {
				$table->string('link_355')->nullable()->after('slug_355');
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