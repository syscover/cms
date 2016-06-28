<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class CmsUpdateV6 extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// change custom_field_group_351
		DBLibrary::renameColumnWithForeignKey('013_351_article_family', 'custom_field_group_351', 'field_group_id_351', 'INT', 10, true, true, 'fk01_013_351_article_family', '001_025_field_group', 'id_025');

		// change article_family_350
		DBLibrary::renameColumnWithForeignKey('013_350_section', 'article_family_350', 'article_family_id_350', 'INT', 10, true, true, 'fk01_013_350_section', '013_351_article_family', 'id_351');

		// change lang_352
		DBLibrary::renameColumnWithForeignKey('013_352_category', 'lang_352', 'lang_id_352', 'VARCHAR', 2, false, false, 'fk01_013_352_category', '001_001_lang', 'id_001');

		// change lang_355
		DBLibrary::renameColumnWithForeignKey('013_355_article', 'lang_355', 'lang_id_355', 'VARCHAR', 2, false, false, 'fk01_013_355_article', '001_001_lang', 'id_001');
		// change author_355
		DBLibrary::renameColumnWithForeignKey('013_355_article', 'author_355', 'author_id_355', 'INT', 10, true, false,'fk02_013_355_article', '001_010_user', 'id_010');
		// change section_355
		DBLibrary::renameColumnWithForeignKey('013_355_article', 'section_355', 'section_id_355', 'VARCHAR', 30, false, false, 'fk03_013_355_article', '013_350_section', 'id_350');
		// change family_355
		DBLibrary::renameColumnWithForeignKey('013_355_article', 'family_355', 'family_id_355', 'INT', 10, true, true,'fk04_013_355_article', '013_351_article_family', 'id_351');

		// change lang_358
		DBLibrary::renameColumnWithForeignKey('013_358_tag', 'lang_358', 'lang_id_358', 'VARCHAR', 2, false, false, 'fk01_013_358_tag', '001_001_lang', 'id_001');
		
		// rename columns
		// editor_type_351
		DBLibrary::renameColumn('013_351_article_family', 'editor_type_351', 'editor_id_351', 'TINYINT', 3, true, false);

		// status_355
		DBLibrary::renameColumn('013_355_article', 'status_355', 'status_id_355', 'TINYINT', 3, true, false);

		// article_356
		DBLibrary::renameColumn('013_356_articles_categories', 'article_356', 'article_id_356', 'INT', 10, true, false);
		// category_356
		DBLibrary::renameColumn('013_356_articles_categories', 'category_356', 'category_id_356', 'INT', 10, true, false);

		// article_359
		DBLibrary::renameColumn('013_359_articles_tags', 'article_359', 'article_id_359', 'INT', 10, true, false);
		// tag_359
		DBLibrary::renameColumn('013_359_articles_tags', 'tag_359', 'tag_id_359', 'INT', 10, true, false);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down(){}
}