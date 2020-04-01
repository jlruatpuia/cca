<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDDOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ddos', function (Blueprint $table) {
            $table->id();
            $table->char('ddo_code', 6)->unique();
            $table->string('ddo_desc');
            $table->char('dept_code', 7)->nullable();
            $table->string('ddo_name')->nullable();
            $table->char('treasury_code', 6)->nullable();
            $table->char('bank_code', 10)->nullable();
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
        Schema::dropIfExists('ddos');
    }
}
