<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeosBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seos_blog', function (Blueprint $table) {
            $table->id();
            $table->string('sb_slug')->nullable();
            $table->string('sb_md5')->unique()->index();
            $table->tinyInteger('sb_type')->default(1)->comment('1 keyword, 2 menu, 3 article');
            $table->integer('sb_id')->default(0);
            $table->unique(['sb_id','sb_type','sb_md5']);
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
        Schema::dropIfExists('seos_blog');
    }
}
