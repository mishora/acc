<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
class CreateItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('office');
            $table->integer('type');
            $table->integer('cat');
            $table->integer('access');
            $table->string('name', 60);
            $table->string('desc', 255);
            $table->double('quantity');
            $table->double('price');
            $table->double('amount');
            $table->integer('issue_date');
            $table->boolean('issue_check');
            $table->integer('pay_date');
            $table->integer('pay_check');
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
        Schema::drop('items');
    }
}
