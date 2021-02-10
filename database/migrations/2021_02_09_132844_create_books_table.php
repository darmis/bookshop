<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('title')->default('No title yet.');
            $table->longText('description')->default('No description yet.');
            $table->string('genre')->default('Unknown');
            $table->string('author')->default('Unknown');
            $table->string('cover')->default('images/covers/default_cover.png');
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('discount')->default(0);
            $table->boolean('isAproved')->default(0);
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
        Schema::dropIfExists('books');
    }
}
