<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('last_name');


		    $table->integer('referente_id')->unsigned()->nullable();
            $table->foreign('referente_id')->references('id')->on('users');
            $table->string('name_referente')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('zone_id')->nullable();
            $table->string('identificacion')->nullable();
            $table->string('profesion')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();

            $table->string('direccion')->nullable();
            $table->date('fecha_nacimiento')->nullable();

            $table->boolean('have_vehicle')->default(false);
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_plate')->nullable();


			//$table->string('email')->unique()->nullable();
			$table->string('email')->nullable();
			$table->string('password', 60)->nullable();
			$table->string('password_string', 60)->nullable();
			$table->integer('user_type_id')->unsigned()->nullable();
            $table->foreign('user_type_id')->references('id')->on('user_types');

            $table->integer('sector_id')->unsigned()->nullable();
            $table->foreign('sector_id')->references('id')->on('sectors');


            $table->boolean('active_account')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_super_admin')->default(false);

			$table->rememberToken();
			$table->timestamps();
		});
	}



		protected $fillable = ['name','last_name',
	 'referente_id','name_referente',
	 'department_id', 'city_id','zone_id','name_city',
	 'identificacion', 'profesion','phone1','phone2',
	 'direccion', 'profesion','phone1','phone2','fecha_nacimiento','direccion',
	 'have_vehicle','vehicle_type','vehicle_plate',
	 'email', 'password','user_type_id','sector_id','active_account','is_admin','is_super_admin'];
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
