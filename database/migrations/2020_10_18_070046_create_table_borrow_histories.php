<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBorrowHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('membership_id')->nullable();
            $table->unsignedBigInteger('book_id')->nullable();
            $table->dateTime('borrowed_date')->nullable();
            $table->dateTime('date_must_return')->nullable();
            $table->string('extension')->nullable();
            $table->decimal('fine', 15, 2)->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->unsignedBigInteger('returning_officer')->nullable();
            $table->unsignedBigInteger('checked_by')->nullable();
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
        Schema::dropIfExists('borrow_histories');
    }
}
