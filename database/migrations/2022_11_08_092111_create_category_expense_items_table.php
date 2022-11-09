<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryExpenseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_expense_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name', 200)->nullable();
            $table->double('quantity',20,2);
            $table->double('rate',20,2);
            $table->double('amount',20,2);

            $table->integer('user_id')->unsigned();
            $table->uuid('category_expense_id');
            $table->uuid('status_id');

            $table->uuid('priority_id');

            $table->date('date');
            $table->date('due_date');

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
        Schema::dropIfExists('category_expense_items');
    }
}
