<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePatientsTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('address')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('skype_name')->nullable()->change();
            $table->string('date_of_birth')->nullable()->change();
            $table->string('session_type')->nullable()->change();
            $table->text('diagnosis')->nullable()->change();
            $table->text('therapy')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('phone');
            $table->dropColumn('skype_name');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('session_type');
            $table->dropColumn('diagnosis');
            $table->dropColumn('therapy');
        });
    }
}
