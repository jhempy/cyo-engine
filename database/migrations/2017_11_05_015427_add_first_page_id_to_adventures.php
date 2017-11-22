<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFirstPageIdToAdventures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adventures', function (Blueprint $table) {
            $table->integer('first_page_id')->unsigned()->nullable();
            $table->foreign('first_page_id')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adventures', function (Blueprint $table) {
            $table->dropForeign('adventures_first_page_id_foreign');
        });
    }
}
