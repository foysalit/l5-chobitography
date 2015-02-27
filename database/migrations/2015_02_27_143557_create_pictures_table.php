<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePicturesTable extends Migration {
	private $tableName = 'pictures';

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->tableName, function(Blueprint $table)
		{
			$table->string('id', 32)->primary();
			$table->string('caption')->index();
			$table->string('details');
			$table->string('path');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::table($this->tableName, function (Blueprint $table)
		{
			$table->dropForeign('posts_user_id_foreign');
		});

		Schema::dropIfExists($this->tableName);
	}

}
