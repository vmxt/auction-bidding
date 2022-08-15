<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_steps', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('approval_id');
            $table->unsignedBigInteger('approver_id');
            $table->string('status', 50);
            $table->dateTime('approved_date');
            $table->dateTime('hold_date');
            $table->dateTime('denied_date');
            $table->integer('is_current')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('approval_id')->references('id')->on('approvals');
            // $table->foreign('approver_id')->references('id')->on('approvers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval_steps');
    }
}
