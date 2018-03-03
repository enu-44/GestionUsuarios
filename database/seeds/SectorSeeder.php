<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Sector;


class SectorSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$sectors =[
            [
                'name_sector'    => 'Sector 1',
                'description_sector'    => 'Sector 1',
                'zone_id'    => 1,
                'sector_type_id'    => 2,
               
            ],
            [
               'name_sector'    => 'Sector 2',
                'description_sector'    => 'Sector 2',
                'zone_id'    => 2,
                'sector_type_id'    => 2,
            ],
            [
                'name_sector'    => 'Sector 3',
                'description_sector'    => 'Sector 3',
                'zone_id'    => 3,
                'sector_type_id'    => 1,
            ],
            [
                'name_sector'    => 'Sector 4',
                'description_sector'    => 'Sector 4',
                'zone_id'    => 4,
                'sector_type_id'    => 1,
            ]
        ];

        foreach ($sectors as $item){
            Sector::create($item);
        }
	}
}
