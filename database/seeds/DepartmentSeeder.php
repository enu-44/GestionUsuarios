<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\Department;
use App\City;


class DepartmentSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$json=public_path().'/data/colombia.json';
        //$json = File::get("database/data/colombia.json");
        $data = json_decode(file_get_contents($json), true);


        $firstElement = head($data);

        $property= "";
        $ciudad="";

        foreach ($data as $obj => $value) {

            Department::create(array(
            'codigodpto' =>  $value['id'],
            'name_department' =>  $value['departamento']
           
            ));

            //Get Last 
            $Last_Department=Department::orderBy('id', 'desc')->first();


            $ciudades = $value['ciudades'];
            foreach ($ciudades as $key => $val) {
                City::create(array(
                    'name_city' => $val,
                    'department_id' => $Last_Department->id
                   
                ));
            }
        }
	}
}