<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListsPersonsTable extends Migration
{
    const table = 'lists_persons';

    public function up()
    {
        Schema::create(self::table, function (Blueprint $table) {
            $table->bigInteger('person_id')->unsigned();
            $table->bigInteger('list_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('list_id')->references('id')->on('lists')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['person_id', 'list_id']);
            $table->unique(['person_id', 'list_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::table);
    }
}
