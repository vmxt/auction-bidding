<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApprovalMessageBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_message_boards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('approval_step_id');
            $table->integer('from_id');
            $table->longText('message');
            $table->string('attachment', 255);
            $table->tinyInteger('is_read');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approval_message_boards');
    }
}
