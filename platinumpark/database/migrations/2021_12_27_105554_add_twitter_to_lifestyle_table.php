<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTwitterToLifestyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lifestyle', function (Blueprint $table) {
            $table->string('twitter')->nullable()->after('whatsapp');
            $table->string('pdf')->nullable()->after('event_email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lifestyle', function (Blueprint $table) {
            $table->dropColumn('twitter');
            $table->dropColumn('pdf');
        });
    }
}
