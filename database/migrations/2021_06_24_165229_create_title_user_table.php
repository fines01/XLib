<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTitleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('title_user', function (Blueprint $table) {
            //$table->id();
            $table->bigInteger('title_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('status_id')->unsigned();
            
            $table->primary(['title_id','user_id']);
            $table->foreign('title_id')->on('titles')->references('id')->onUpdate('cascade')->onDelete('restrict'); // ist onDelete(restrict) default?
            $table->foreign('user_id')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->on('statuses')->references('id')->onUpdate('cascade')->onDelete('restrict');

            //$table->integer('max_loan_days'); //max loan period in in days
            $table->string('condition'); //enum, radio-btns (sher gut, mittel, sehr mitgenommen etc.), oder string mit user- beschreibung?
            $table->string('possible_delivery_methods')->nullable(); // personal, mail-delivery. personal: only possible if user has country & state deposited & agreed.
            
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
        Schema::dropIfExists('title_user');
    }
}