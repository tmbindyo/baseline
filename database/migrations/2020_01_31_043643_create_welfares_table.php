<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelfaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('welfares', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('location', 200);
            $table->double('amount',200,2);
            $table->double('paid',200,2);
            $table->date('due_date');

            $table->integer('user_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->uuid('status_id');
            $table->uuid('meeting_id');
            $table->uuid('chama_id');

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
        Schema::dropIfExists('welfares');
    }
}
