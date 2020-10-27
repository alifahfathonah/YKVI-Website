<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_cmes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('type');
            $table->string('title');
            $table->string('link_embed_youtube');
            $table->string('link_url_zoom');
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
        Schema::dropIfExists('ms_cmes');
    }
}
