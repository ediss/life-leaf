<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsultationAndPriceToPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->timestamp('date_of_consultation')->nullable();
            $table->string('consultation');
            $table->string('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('patients', 'date_of_consultation')) {

            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn('date_of_consultation');
            });
        }

        if (Schema::hasColumn('patients', 'consultation')) {

            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn('consultation');
            });
        }

        if (Schema::hasColumn('patients', 'price')) {

            Schema::table('patients', function (Blueprint $table) {
                $table->dropColumn('price');
            });
        }
    }
}
