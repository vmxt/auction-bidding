<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApproversSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approvers_setting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('approver_id');
            $table->boolean('notif_for_new_suppliers')->default(1);
            $table->boolean('notif_for_monthly_unapproved_request')->default(1);
            $table->boolean('notif_to_forward_request_to_next_approver')->default(1);
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
        Schema::dropIfExists('approvers_setting');
    }
}
