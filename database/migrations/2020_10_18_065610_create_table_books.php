<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collection_type_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('type_of_procurement_id')->nullable();
            $table->string('book_number')->nullable();
            $table->string('title')->nullable();
            $table->text('abstract')->nullable();
            $table->string('publisher')->nullable();
            $table->string('place_of_publication')->nullable();
            $table->string('publication_year')->nullable();
            $table->bigInteger('pages')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('stock')->nullable();
            $table->string('barcode')->nullable();
            $table->string('edition')->nullable();
            $table->string('cetakan')->nullable();
            $table->string('language')->nullable();
            $table->text('translator')->nullable();
            $table->bigInteger('length')->nullable();
            $table->bigInteger('width')->nullable();
            $table->dateTime('date_received')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->dateTime('approval_date')->nullable();
            $table->unsignedBigInteger('published_by')->nullable();
            $table->dateTime('publish_date')->nullable();
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
        Schema::dropIfExists('books');
    }
}
