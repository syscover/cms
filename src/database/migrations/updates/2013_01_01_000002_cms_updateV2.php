<?php

use Illuminate\Database\Migrations\Migration;
use \Illuminate\Support\Facades\DB;


class CmsUpdateV2 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::select('ALTER TABLE 013_355_article CHANGE title_355 title_355 VARCHAR(510) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL');
		DB::select('ALTER TABLE 013_355_article CHANGE date_355 date_355 INT(10) UNSIGNED NULL');
		DB::select('ALTER TABLE 013_355_article CHANGE sorting_355 sorting_355 INT(10) UNSIGNED NULL');
		DB::select('ALTER TABLE 013_355_article CHANGE sorting_355 sorting_355 INT(10) UNSIGNED NULL');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}