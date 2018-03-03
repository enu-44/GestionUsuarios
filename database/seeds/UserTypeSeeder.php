<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\UserType;


class UserTypeSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user_type =[
            [
                'name_user_type'    => 'Candidato',
            ],
            [
                'name_user_type'    => 'Lider',
            ],
            [
                'name_user_type'    => 'Usuario',  
            ]
        ];

        foreach ($user_type as $item){
            UserType::create($item);
        }
	}
}