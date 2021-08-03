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
            $table->unsignedBigInteger('title_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('status_id'); //->nullable()?
            
            $table->primary(['title_id','user_id']);
            $table->foreign('title_id')->on('titles')->references('id')->onUpdate('cascade')->onDelete('restrict'); // ist onDelete(restrict) default?
            $table->foreign('user_id')->on('users')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_id')->on('statuses')->references('id')->onUpdate('cascade')->onDelete('restrict');

            $table->integer('max_loan_days')->default(60); //max loan period in in days. Später ev vom User selber definierbar.
            $table->string('condition')->default("o.k."); //enum, radio-btns (sher gut, mittel, sehr mitgenommen etc.), oder string mit user- beschreibung? // default ok, ->nullable() entfernen
            $table->set('possible_delivery_methods',['mail', 'personal']); // personal, mail-delivery. personal: nur mögl wenn User Adresse und Namen hinterlegt hat. // Type ÄNDERN auf set(in-person, postal) & nicht nullable!
            
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