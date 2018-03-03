<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('zones', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('name_zone');
			$table->string('description_zone');
			
            $table->integer('sector_type_id')->unsigned();
            $table->foreign('sector_type_id')->references('id')->on('sector_types');

            $table->integer('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities');


            

            $table->float('latitud_zone')->nullable();
			$table->float('longitud_zone')->nullable();


			


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
		Schema::drop('zones');
	}

}
