<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableFamily extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_351_family', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id_351')->unsigned();
            $table->string('name_351', 100);
            $table->tinyInteger('image_width_351')->unsigned();
            $table->tinyInteger('image_height_351')->unsigned();
            $table->tinyInteger('editor_type_351')->unsigned(); //text = 0, wysiwyg = 1 or contentbuilder = 0
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_351_family');
    }

}
