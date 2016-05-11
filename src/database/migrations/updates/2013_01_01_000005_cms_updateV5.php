<?php

use Illuminate\Database\Migrations\Migration;


class CmsUpdateV5 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasColumn('013_352_category', 'slug_352'))
		{
			Schema::table('013_352_category', function ($table) {
				$table->string('slug_352')->nullable()->after('name_352');
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