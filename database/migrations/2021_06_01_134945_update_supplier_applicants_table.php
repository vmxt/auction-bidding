<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSupplierApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_applicants', function (Blueprint $table) {
            $table->string('contact_person1')->nullable();
            $table->string('contact_person2')->nullable();
            $table->string('contact_person3')->nullable();
            $table->string('contact_person4')->nullable();
            $table->string('designation1')->nullable();
            $table->string('designation2')->nullable();
            $table->string('designation3')->nullable();
            $table->string('designation4')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('email3')->nullable();
            $table->string('email4')->nullable();

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
            $table->dropColumn(['contact_person1','contact_person2','contact_person3','contact_person4','designation1','designation2','designation3','designation4','email1','email2','email3','email4']);
        });
    }
}
