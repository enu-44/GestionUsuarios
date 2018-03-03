<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		 $this->command->info('Unguarding models');
	    Model::unguard();
      $tables = [
         'user_types',
         
          ];
		$this->command->info('Truncating existing tables');
        foreach ($tables as $table) {  
        DB::statement('TRUNCATE TABLE ' . $table . ' CASCADE');
    }
		
		 $this->call('UserTypeSeeder');

		 $this->call('DepartmentSeeder');
		 $this->call('ZoneTypeSeeder');
		 $this->call('SectorTypeSeeder');
		 $this->call('ZoneSeeder');
		 $this->call('SectorSeeder');

		  $this->call('UserSeeder');
		 
	}
}
