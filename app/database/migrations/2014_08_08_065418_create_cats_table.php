<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCatsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cats', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->string('img');
            $table->dateTime('birthday');
            $table->integer('user_id')->unsigned();
            $table->integer('breed_id')->unsigned();
			$table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('breed_id')->references('id')->on('breeds');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('cats', function(Blueprint $table)
        {
            $table->dropForeign('cats_user_id_foreign');
            $table->dropForeign('cats_brred_id_foreign');
        });
		Schema::drop('cats');
	}

}
