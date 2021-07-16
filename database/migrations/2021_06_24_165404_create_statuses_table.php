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
            $table->foreign('booking_id')->on('bookings')->references('id')->onUpdate('cascade')->onDelete('set null')->nullable();
            $table->boolean('available')->default(1);
            // $table->string | set('booking_status')->nullable(); //delivered, received, returned, locked || available, requested (by user), confirmed (by owner), [set_private bzw. locked] ...->default('available');
            $table->date('booking_date')->nullable();
            $table->date('return_date')->nullable();
            $table->boolean('notification_sent')->nullable(); // ?? Email Eigentümer bei Buchung.
            $table->enum('delivery_method', ['mail', 'personal'])->nullable();          
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