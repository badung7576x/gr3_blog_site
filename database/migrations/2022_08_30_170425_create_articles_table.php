<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('title');
            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('session_id')->nullable();
            $table->string('header_thumbnail')->nullable();
            $table->text('summary')->nullable();
            $table->text('content')->nullable();
            $table->dateTime('publish_schedule')->nullable();
            $table->dateTime('publish_time')->nullable();
            $table->string('tags')->nullable();
            $table->integer('status');   
            $table->bigInteger('created_by')->nullable();    
            $table->bigInteger('review_by')->nullable();    
            $table->integer('review_status')->nullable();    
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
    }
};
