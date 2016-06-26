<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableCategory extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_352_category', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->integer('id_352')->unsigned();
            $table->string('lang_id_352', 2);
            $table->string('name_352');
            $table->string('slug_352')->nullable();
            $table->integer('sorting_352')->unsigned()->nullable();

            $table->text('data_lang_352')->nullable();
            $table->text('data_352')->nullable();
            
            $table->foreign('lang_id_352', 'fk01_013_352_category')->references('id_001')->on('001_001_lang')
                ->onDelete('restrict')->onUpdate('cascade');
            $table->primary(['id_352', 'lang_id_352'], 'pk01_013_352_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_352_category');
    }

}
