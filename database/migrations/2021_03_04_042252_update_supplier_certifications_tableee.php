<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSupplierCertificationsTableee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('supplier_certifications', function (Blueprint $table) {
            $table->string('certification_number')->nullable();
            $table->timestamp('certification_validity')->nullable();
            $table->string('certification_body')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('supplier_certifications', function (Blueprint $table) {
            $table->dropColumn(['certification_body','certification_number', 'certification_validity']);
        });
    }
}
