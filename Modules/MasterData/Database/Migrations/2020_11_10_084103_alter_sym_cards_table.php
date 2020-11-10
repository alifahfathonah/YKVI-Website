<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSymCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::select("ALTER TABLE `ms_sym_cards` 
            CHANGE COLUMN `link_embed_youtube` `link_embed_youtube`  VARCHAR(191) NULL,
            CHANGE COLUMN `description` `description` LONGTEXT NOT NULL;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
