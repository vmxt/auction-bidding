<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_applicants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('address');
            $table->text('commodities');
            $table->string('contact_person');
            $table->string('territory');
            $table->string('designation');
            $table->string('email');
            $table->string('status')->default('Pending');       
            $table->string('approved_by')->nullable();  
            $table->datetime('approved_time')->nullable();  
            $table->string('disapproved_by')->nullable();  
            $table->datetime('disapproved_time')->nullable();  
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
        Schema::dropIfExists('supplier_applicants');
    }
}
