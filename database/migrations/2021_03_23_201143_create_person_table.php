<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    const table = 'persons';

    public function up()
    {
        Schema::create(self::table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('gender', ['M', 'F']);
            $table->string('city');
            $table->string('state');
            $table->timestamps();

            $table->index('gender');
            $table->index('city', 'state');
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::table);
    }
}
