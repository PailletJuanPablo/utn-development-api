<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('parent_category')->unsigned()->nullable();
            $table->foreign('parent_category')->references('id')->on('categories');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->integer('school_id')->unsigned()->nullable();
            $table->foreign('school_id')->references('id')->on('schools');
            $table->integer('modified_by')->unsigned()->nullable();
            $table->foreign('modified_by')->references('id')->on('users');
            $table->boolean('featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('event_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->dateTime('date');
            $table->boolean('show_hour')->default(false);
            $table->integer('event_type')->unsigned()->nullable();
            $table->foreign('event_type')->references('id')->on('event_types');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->integer('parent_page')->unsigned()->nullable();
            $table->foreign('parent_page')->references('id')->on('pages');
            $table->integer('modified_by')->unsigned()->nullable();
            $table->foreign('modified_by')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_types');
    }
}
