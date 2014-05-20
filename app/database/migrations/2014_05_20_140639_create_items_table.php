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
            $table->string('name', 60);
            $table->string('desc', 255);
            $table->float('amount');
            $table->integer('issue_date');
            $table->boolean('issue_check');
            $table->integer('paydate_date');
            $table->integer('status');
            $table->integer('created');
            $table->integer('updated');
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
