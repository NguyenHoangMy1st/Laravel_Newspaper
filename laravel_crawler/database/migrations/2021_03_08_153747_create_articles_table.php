<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
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
            $table->string('a_name')->nullable();
            $table->string('a_slug')->index()->unique();
            $table->string('a_description',300)->nullable();
            $table->tinyInteger('a_hot')->default(0);
            $table->tinyInteger('a_status')->default(1);
            $table->integer('a_menu_id')->default(0);
            $table->integer('a_view')->default(0);
            $table->text('a_content');
            $table->integer('a_auth_id')->default(0);
            $table->string('a_title_seo')->nullable();
            $table->string('a_description_seo')->nullable();
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
}
