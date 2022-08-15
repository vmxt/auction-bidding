<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempTableForActiveSupplierUpdates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_temp_updates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->unsinged();
            $table->string('action')->nullable();
            $table->string('table_name')->nullable();
            $table->string('ref')->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
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
        Schema::dropIfExists('supplier_temp_updates');
    }
}
