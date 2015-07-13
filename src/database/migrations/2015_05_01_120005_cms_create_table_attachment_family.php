<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CmsCreateTableAttachmentFamily extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('013_353_attachment_family', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id_353')->unsigned();
            $table->string('name_353', 100);
            $table->smallInteger('width_353')->unsigned();
            $table->smallInteger('height_353')->unsigned();
            $table->text('data_353')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('013_353_attachment_family');
    }
}
