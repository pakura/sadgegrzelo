<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSadgegrzeloCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadgegrzelo_category', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sadgegrzeloebi_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('sadgegrzeloebi_id')->references('id')->on('sadgegrzeloebi');
            $table->foreign('category_id')->references('id')->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sadgegrzelo_category');
    }
}
