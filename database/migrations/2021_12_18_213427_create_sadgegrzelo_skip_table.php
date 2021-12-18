<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSadgegrzeloSkipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sadgegrzelo_skip', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->nullable();
            $table->string('device_id', 515)->nullable();
            $table->unsignedBigInteger('sadgegrzeloebi_id');
            $table->timestamps();

            $table->foreign('sadgegrzeloebi_id')->references('id')->on('sadgegrzeloebi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sadgegrzelo_skip');
    }
}
