<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSupplierApplicantssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_applicants', function (Blueprint $table) {
            $table->text('commodities')->nullable()->change();
            $table->string('designation')->nullable()->change();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_applicants', function (Blueprint $table) {
            $table->string('designation')->nullable(false)->change();    
            $table->text('commodities')->nullable(false)->change();    
        });
    }
}
