<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectorTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sector_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name_sector_type');
          	$table->integer('zone_type_id')->unsigned();
            $table->foreign('zone_type_id')->references('id')->on('zone_types');
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
		Schema::drop('sector_types');
	}

}
