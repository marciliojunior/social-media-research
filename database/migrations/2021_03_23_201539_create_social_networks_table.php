<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialNetworksTable extends Migration
{
    const table = 'social_networks';

    public function up()
    {
        Schema::create(self::table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->json('config');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(self::table);
    }
}
