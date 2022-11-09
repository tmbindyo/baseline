<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('reference');
            $table->longText('notes');

            $table->double('sub_total',20,2);
            $table->double('adjustment',20,2);
            $table->double('total',20,2);
            $table->double('paid',20,2);
            $table->double('balance',20,2)->nullable();

            $table->date('date');
            $table->date('due_date')->nullable();
            $table->date('start_repeat')->nullable();
            $table->date('end_repeat')->nullable();

            $table->boolean('has_items')->nullable();

            $table->uuid('category_id');
            $table->integer('user_id')->unsigned();
            $table->boolean('is_institution');
            $table->uuid('institution_id')->nullable();
            $table->uuid('status_id');

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
        Schema::dropIfExists('category_expenses');
    }
}
