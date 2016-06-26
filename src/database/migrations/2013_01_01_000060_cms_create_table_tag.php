<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableTag extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_358_tag', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            
            $table->increments('id_358')->unsigned();
            $table->string('lang_id_358', 2);
            $table->string('name_358')->nullable();

            $table->foreign('lang_id_358', 'fk01_013_358_tag')->references('id_001')->on('001_001_lang')
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
        Schema::drop('013_358_tag');
    }
}
