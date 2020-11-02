<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSymCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_sym_cards', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->string('title');
            $table->string('sym_card_image');
            $table->string('description');
            $table->string('link_embed_youtube');
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
        Schema::dropIfExists('ms_sym_cards');
    }
}
