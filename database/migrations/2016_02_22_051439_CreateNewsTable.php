<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id_news');
            $table->integer('id_job')->nullable();
            $table->integer('id_category')->nullable();
            $table->string('title');
            $table->text('content');
            $table->timestamps();
            $table->jsonb('date_news');
        });

        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id_address');
            $table->json('object');
            $table->integer('id_news');
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
