<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('titles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('author_id')->on('authors')->references('id')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('category_id')->on('categories')->references('id')->onUpdate('cascade')->onDelete('restrict');
            
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('description')->nullable();

            $table->integer('edition')->nullable();
            $table->string('publisher');
            $table->year('publication_year');
            $table->enum('publication_format', ['hardcover','softcover', 'other']); //hardcover, softcover, paperback ?  & other für spezielle Ausgaben (Leder etc). [Einige Verlage vergeben nur eine ISBN-Nummer und verwenden diese für Hardcover- und  Paperback-Ausgaben, aber heute immer noch häufig?]
            $table->char('isbn_10',13)->nullable(); //Nummern plus Bindestriche, und "X"?
            $table->char('isbn_13',17)->nullable();
            $table->char('asin',10)->nullable(); //Amazons ASIN wird auch immer wichtiger.
            $table->string('title_img')->nullable();
            $table->integer('amount');
            
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
        Schema::dropIfExists('titles');
    }
}