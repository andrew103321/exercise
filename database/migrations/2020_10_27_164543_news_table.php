<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->Increments('id');
            $table->char('newsID', 32);
            $table->string('name', 100);
            $table->text('content');
            $table->string('publishDate', 20);
            $table->integer('isDeleted')->default(0)->comment('已刪除=1,未刪除=0');
            $table->string('createdTime', 10);
            $table->string('updatedTime', 10);
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
        Schema::dropIfExists('test');
    }
}
