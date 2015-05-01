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
            $table->string('lang_352',2);
            $table->string('name_352', 100);
            $table->text('data_352')->nullable();

            $table->primary(['id_352', 'lang_352']);
            $table->foreign('lang_352')->references('id_001')->on('001_001_lang')
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
        Schema::drop('013_352_category');
    }

}
