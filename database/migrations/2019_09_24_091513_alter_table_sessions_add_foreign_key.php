<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableSessionsAddForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->bigInteger('patient_id')->unsigned()->index()->change();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'patient_id')) {
            Schema::table('sessions', function (Blueprint $table) {
                $table->dropForeign("sessions_patient_id_foreign");
                $table->dropColumn('patient_id');
            });
        }
       
    }
}
