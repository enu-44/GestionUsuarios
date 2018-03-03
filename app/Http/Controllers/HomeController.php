<?php namespace App\Http\Controllers;

use File;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

		//$path = storage_path() . "/json/${filename}.json"; // ie: /var/www/laravel/app/storage/json/filename.json
		//$json = json_decode(file_get_contents($path), true);

		$json=public_path().'/data/colombia.json';
		//$json = File::get("database/data/colombia.json");
        $data = json_decode(file_get_contents($json), true);


        $firstElement = head($data);

        $property= "";
        $ciudad="";

        foreach ($data as $obj => $value) {
        	//$property=	$obj->id;
        	$property = $value['ciudades'];
        	foreach ($property as $key => $val) {
        		$ciudad=$val;
        	}
        }



		return   view("home");
	}


	
  public function missingMethod($parameters=array()){
    abort(404);
  }

}
