<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('title');
            $table->string('img');
            $table->text('description');
            $table->integer('user_id')->unsigned();
			$table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('articles', function(Blueprint $table)
        {
           $table->dropForeign('articles_user_id_foreign');
        });
		Schema::drop('articles');
	}

}
