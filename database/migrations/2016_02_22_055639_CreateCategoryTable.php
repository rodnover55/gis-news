<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
          alter table "news"
            ALTER COLUMN id_category TYPE varchar(255)
            USING (id_category::varchar(255));'
        );

        Schema::create('categories', function (Blueprint $table) {
            $table->string('id_category');
            $table->string('name');
            $table->text('description');
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
        //
    }
}
