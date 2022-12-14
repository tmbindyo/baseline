<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscription_payments', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->decimal('amount', 20,2);

            $table->integer('user_id')->unsigned()->nullable();
            $table->uuid('status_id');
            $table->uuid('subscription_type_id');
            $table->uuid('subscription_id');

            $table->uuid('is_admin_recorded');

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
        Schema::dropIfExists('subscription_payments');
    }
}
