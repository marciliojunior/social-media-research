<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    const table = 'posts';

    public function up()
    {
        Schema::create(self::table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->dateTime('post_date');
            $table->longText('content');

            $table->index('account_id');
            $table->index('post_date');
        });

        \DB::statement('ALTER TABLE posts ADD FULLTEXT full(content)');
    }

    public function down()
    {
        Schema::dropIfExists(self::table);
    }
}
