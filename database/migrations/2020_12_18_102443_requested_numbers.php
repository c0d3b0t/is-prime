<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RequestedNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requested_numbers', function (Blueprint $table) {
            $table->unsignedBigInteger('number');
            $table->unsignedBigInteger('count');
            $table->boolean('is_prime');

            $table->index('number');
            $table->index('count');
            $table->index('is_prime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requested_numbers', function (Blueprint $table) {
            $table->dropColumn('number');
            $table->dropColumn('count');
        });
    }
}
