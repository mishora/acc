<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreatePartnersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function(Blueprint $table) {
            $table->increments( 'id' );
            $table->string('short_name', 32);
            $table->string('full_name',255);
            $table->string('mol', 64);
            $table->string('country', 64);
            $table->string('eic', 32);
            $table->string('vat', 32);
            $table->string('bank', 64);
            $table->string('bic', 16);
            $table->string('iban', 32);
            $table->string('address', 255);
            $table->string('mail', 60);
            $table->string('phone', 32);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('partners');
    }
}
