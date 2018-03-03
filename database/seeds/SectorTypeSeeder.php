<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\SectorType;


class SectorTypeSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$sector_type =[
            [
                'name_sector_type'    => 'Barrio',
                'zone_type_id'    => 2,
            ],
            [
                'name_sector_type'    => 'Vereda',
                'zone_type_id'    => 1,
            ],
            [
                'name_sector_type'    => 'Corregimiento',  
                 'zone_type_id'    => 1,
            ],
            [
                'name_sector_type'    => 'Comuna',  
                'zone_type_id'    => 2,
            ]
        ];

        foreach ($sector_type as $item){
            SectorType::create($item);
        }
	}
}