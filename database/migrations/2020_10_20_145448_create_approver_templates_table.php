<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproverTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approver_templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('approver_id');
            $table->unsignedInteger('template_id');
            $table->integer('sequence_no');
            $table->integer('is_alternate_approver');
            $table->timestamps();

            // $table->foreign('approver_id')->references('id')->on('approvers');
            // $table->foreign('template_id')->references('id')->on('templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approver_templates');
    }
}
