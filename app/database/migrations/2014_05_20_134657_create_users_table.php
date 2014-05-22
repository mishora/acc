<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments( 'id' );
            $table->string('username', 30);
            $table->string('password', 60);
            $table->string('email', 60);
            $table->string('name', 20);
            $table->string('last_name', 20);
            $table->integer('pd' );
            $table->string('token', 100);
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
        Schema::drop('users');
    }
}
