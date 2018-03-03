<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Zone;


class ZoneSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run()
	{
		$zone =[
            [
                'name_zone'    => 'Zone 1',
                'description_zone'    => 'Zone 1',
                'sector_type_id'    => 3,
                'city_id'    => 658,
               
            ],
            [
                'name_zone'    => 'Zone 2',
                'description_zone'    => 'Zone 2',
                'sector_type_id'    => 3,
                'city_id'    => 658,
               
            ],
            [
                'name_zone'    => 'Zone 3',
                'description_zone'    => 'Zone 3',
                'sector_type_id'    => 4,
                'city_id'    => 658,
              
            ],
            [
                'name_zone'    => 'Zone 4',
                'description_zone'    => 'Zone 4',
                'sector_type_id'    => 4,
                'city_id'    => 658,
              
            ]
        ];

        foreach ($zone as $item){
            Zone::create($item);
        }
	}
}


