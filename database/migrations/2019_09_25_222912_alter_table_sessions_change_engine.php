<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSessionsChangeEngine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->engine = 'InnoDB';

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->engine = 'MyISAM';
        });
    }
}
