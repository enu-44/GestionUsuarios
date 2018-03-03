<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use App\User;


class UserSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */

	public function run()
	{
		$user =[
            [
                'name'    => "Administrador",
                'last_name'    => "Super Usuario",
                'email'    => "administrador@hotmail.com",
                'password'    => bcrypt("1234567"),
                'active_account'    => true,
                'is_admin'    => true,
                'is_super_admin'    => true,
            ]
        ];

        foreach ($user as $item){
            User::create($item);
        }
	}
}

