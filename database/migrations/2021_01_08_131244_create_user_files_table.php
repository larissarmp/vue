<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_group')->unsigned();
            $table->string('name');
            $table->string('email', 100);
            $table->string('group_name');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_group')
            ->references('id')->on('groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_files', function (Blueprint $table) {
            $table->dropForeign(['id_group']);
        });
        Schema::dropIfExists('user_files');
    }
}
