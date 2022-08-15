<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('supplier_id');
            $table->string('company_name', 150)->nullable();
            $table->string('tin', 150)->nullable();
            $table->tinyInteger('vat_registered')->nullable();
            $table->date('date_established')->nullable();
            $table->string('website', 150)->nullable();
            $table->string('organization_type', 250)->nullable();
            $table->timestamps();
            $table->softDeletes();

            //$table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_details');
    }
}
