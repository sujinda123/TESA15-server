<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLemonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lemons', function (Blueprint $table) {
            $table->id();
            $table->integer('good_lemon');
            $table->integer('bad_lemon');
            $table->integer('small_lemon');
            $table->integer('medium_lemon');
            $table->integer('big_lemon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lemons');
    }
}
