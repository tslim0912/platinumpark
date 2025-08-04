<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPdf2ToLifestyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lifestyle', function (Blueprint $table) {
            $table->string('pdf2')->nullable()->after('pdf');
            $table->string('menu2')->nullable()->after('menu');
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
            $table->dropColumn('pdf2');
            $table->dropColumn('menu2');
        });
    }
}
