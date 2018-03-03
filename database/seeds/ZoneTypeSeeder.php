<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\ZoneType;


class ZoneTypeSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$zone_type =[
           
            [
                'name_zone_type'    => 'Rural',  
            ],
            [
                'name_zone_type'    => 'Urbano',  
            ]
        ];

        foreach ($zone_type as $item){
            ZoneType::create($item);
        }
	}
}