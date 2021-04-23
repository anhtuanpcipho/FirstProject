<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_works', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unique_id');
            $table->string('image');
            $table->string('title');
            $table->string('collaborator');
            $table->timestamps();
            $table->string('deadline');
            $table->string('workdone');
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history_works');
    }
}
