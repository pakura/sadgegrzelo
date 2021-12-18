<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('table_name', 64)->index();
            $table->unsignedBigInteger('table_id')->index();
            $table->boolean('visible')->default(1);
            $table->unsignedSmallInteger('position')->default(1);
            $table->timestamps();
        });

        Schema::create('file_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('file_id');
            $table->char('language', 2);
            $table->string('title');
            $table->string('file');
            $table->timestamps();

            $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_languages');

        Schema::dropIfExists('files');
    }
}
