<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->nullable();
            $table->foreign('booking_id')->on('bookings')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('available'); //->default(1)?
            // $table->string('booking_status')->nullable(); //delivered, received, returned, locked || available, booked
            $table->date('booking_date')->nullable();
            $table->date('return_date')->nullable();
            $table->boolean('notification_sent')->nullable(); // ?? // Email Eigentümer bei Buchung.
            $table->set('delivery_method', ['mail', 'personal']); // enum(...)->nullable(); ? & mehrere mögl Werte
           
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
        Schema::dropIfExists('statuses');
    }
}