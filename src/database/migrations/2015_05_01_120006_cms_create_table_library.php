<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableLibrary extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_354_library', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id_354')->unsigned();
            $table->string('file_name_354', 1020)->nullable();
            $table->string('mime_354', 255);
            $table->integer('size_354')->unsigned();
            $table->tinyInteger('type_354')->unsigned();                    // 1 = image, 2 = file, 3 = video
            $table->string('type_text_354', 50);
            $table->smallInteger('width_354')->unsigned()->nullable();
            $table->smallInteger('height_354')->unsigned()->nullable();
            $table->text('data_354')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_354_library');
    }
}