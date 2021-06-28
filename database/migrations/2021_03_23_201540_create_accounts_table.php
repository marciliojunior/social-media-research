<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    const table = 'accounts';

    public function up()
    {
        Schema::create(self::table, function (Blueprint $table) {
            $table->id();
            $table->bigInteger('person_id')->unsigned();
            $table->foreign('person_id')->references('id')->on('persons')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->bigInteger('social_network_id')->unsigned();
            $table->foreign('social_network_id')->references('id')->on('social_networks')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('email');
            $table->timestamps();

            $table->index('person_id');
            $table->index('social_network_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::table);
    }
}
