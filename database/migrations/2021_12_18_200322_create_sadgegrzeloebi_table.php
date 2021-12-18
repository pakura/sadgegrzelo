<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSadgegrzeloebiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadgegrzeloebi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('collection_id');
            $table->string('slug')->unique();
            $table->boolean('visible')->default(1);
            $table->unsignedBigInteger('position')->default(1);
            $table->string('image')->nullable();
            $table->text('tags')->nullable();
            $table->timestamps();

            $table->foreign('collection_id')->references('id')->on('collections');
        });

        Schema::create('sadgegrzeloebi_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sadgegrzeloebi_id');
            $table->char('language', 2);
            $table->string('title');
            $table->mediumText('content')->nullable();
            $table->timestamps();

            $table->foreign('sadgegrzeloebi_id')->references('id')->on('sadgegrzeloebi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sadgegrzeloebi_languages');
        Schema::dropIfExists('sadgegrzeloebi');
    }
}
