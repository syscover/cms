<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableFile extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_354_file', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id_354')->unsigned();
            $table->string('file_354', 1020);
            $table->string('mime_354', 255);
            $table->integer('size_354');
            $table->boolean('is_image_354');
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
        Schema::drop('013_354_file');
    }
}
