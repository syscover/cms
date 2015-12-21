<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableSection extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_350_section', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->string('id_350', 30)->primary();
            $table->string('name_350', 100);
            $table->integer('article_family_350')->unsigned()->nullable();

            $table->foreign('article_family_350', 'fk01_013_350_section')->references('id_351')->on('013_351_article_family')
                ->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_350_section');
    }

}
