<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUploadFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user_file')->unsigned();
            $table->string('name_file');
            $table->string('name_user');
            $table->string('url_file');
            $table->string('size_file');

            $table->timestamps();
            $table->softDeletes();

            
            $table->foreign('id_user_file')
            ->references('id')->on('user_files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('upload_files', function (Blueprint $table) {
            $table->dropForeign(['id_user_file']);
        });
        Schema::dropIfExists('upload_files');
    }
}
