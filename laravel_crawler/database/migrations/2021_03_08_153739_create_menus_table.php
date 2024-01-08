<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('m_name');
            $table->string('m_description')->nullable();
            $table->string('m_slug')->unique();
            $table->string('m_icon')->nullable();
            $table->tinyInteger('m_sort')->default(0);
            $table->tinyInteger('m_status')->default(1);
            $table->tinyInteger('m_hot')->default(0);
            $table->integer('m_parent_id')->default(0)->index();
            $table->string('m_title_seo')->nullable();
            $table->string('m_description_seo')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
