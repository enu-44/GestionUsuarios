<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Validation\UserRegisterValidation;
use App\Department;
use App\UserType;
use App\SectorType;
use App\ZoneType;
use App\User;
use App\City;
use App\Zone;
use App\Sector;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserUpdateRequest;
use DB;




class UsuarioController extends Controller {


	public function __construct(Request $request, UserRegisterValidation $userRegisterValidation)
	{
        $this->middleware('auth');
        $this->UserReferenteId=array();
        $this->UserReferente=array();
        $this->UserReferenteList=array();
        $this->UserReferenteByZones=array();


        $this->userRegisterValidation = $userRegisterValidation;
      
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    public function getIndex()
	{

	 $usuario = Auth::user();

	  $this->UserReferenteList($usuario->id);
      $users= $this->UserReferenteList;



	  return view('user.mostrar',compact("users"));

	}








	public function getViewReferentes($id)
	{
	   $referentes = User::join('user_types', 'user_types.id', '=', 'users.user_type_id')
                   ->where('users.referente_id', '=', $id)
                   ->select('users.id', 'users.name', 'users.last_name', 'users.identificacion',
                   	'users.direccion','users.phone1', 'users.phone2', 'users.email',
                   	'user_types.name_user_type')
                   ->get();

	
	  return view('user.view_referentes',compact("referentes"));

	}





	 public function getRegisterUser()
	{

	 $usuario = Auth::user();

	  
	 $departments= Department::all();
	 $zone_types= ZoneType::all();
     $usertypes;

      if($usuario->is_admin==true){
      	$usertypes= UserType::all();
      }else{
      	$usertypes=UserType::where('name_user_type', '!=', "Candidato")->get();
      }

     

     //$users= User::where('users.id', '!=', $usuario->id)->get();
     $users;
     if($usuario->is_admin==true){
      	$users= User::where('is_admin', '!=', 1)->get();
      }else{
      	$this->UserReferente($usuario->id);
	     if($usuario->is_admin!=true || $usuario->is_super_admin!=true){
	     	 $this->UserReferente[] =$usuario;
	     }
	    
	     $users=$this->UserReferente;
     }

     
    

	  return view('user.register_user',compact("departments","usertypes","users","zone_types"));

	}



	public function postRegisterUser(UserAddRequest $request)
	{

		$usuario = Auth::user();


		
		$name = $request->get('name');
		$last_name = $request->get('last_name');
		$user_type_id = $request->get('user_type_id');
		$identificacion = Input::get('identificacion');
		$direccion = Input::get('direccion');
		$fecha_nacimiento = Input::get('fecha_nacimiento');
		$profesion = Input::get('profesion');
		$referente_id = $request->get('referente_id');
		$sector = $request->get('sector');
		$zona = $request->get('zona');
		$ciudad = $request->get('ciudad');
		$departamento =$request->get('departamento');
		$phone1 = Input::get('phone1');
		$phone2 = Input::get('phone2');
		$have_vehicle = Input::get('have_vehicle');
		$vehicle_type = Input::get('vehicle_type');
		$vehicle_plate = Input::get('vehicle_plate');
		$email = $request->get('email');
		$password = $request->get('password');


		if(($referente_id==NULL || $referente_id=='') && ($usuario->is_admin==false)){

			if($email!=''  || $password!=NULL){
				$validator = $this->userRegisterValidation->validatorCredentials($request->all());
				if ($validator->fails())
				{
					$this->throwValidationException(
						$request, $validator
					);
				}
			}

			$referente_id=$usuario->id;
		}else{

			$user_type=UserType::where('id', '=', $user_type_id)->first();
			
			/*
			if($user_type->name_user_type!='Candidato'  && $user_type->name_user_type=='Lider' ){
				$validator = $this->userRegisterValidation->validatorCredentials($request->all());
				if ($validator->fails())
				{
					$this->throwValidationException(
						$request, $validator
					);
				}
			}*/

			if($user_type->name_user_type!='Candidato' ){
				
				$validatorUserType = $this->userRegisterValidation->validatorLiderOrUser($request->all());
				if ($validatorUserType->fails())
				{
					$this->throwValidationException(
						$request, $validatorUserType
					);
				}
			}


			else{

				$referente_id=NULL;
			}

		}

		if($sector==NULL || $sector==''){
			$sector=NULL;
		}

		if($zona==NULL || $zona==''){
			$zona=NULL;
		}


		if($ciudad==NULL || $ciudad==''){
			$ciudad=NULL;
		}


		if($departamento==NULL || $departamento==''){
			$departamento=NULL;
		}

		if($have_vehicle==NULL || $have_vehicle==''){
			$have_vehicle=false;
		}

		if($fecha_nacimiento==NULL || $fecha_nacimiento=='' || $fecha_nacimiento==0){
			$fecha_nacimiento=NULL;
		}

		


		


		$name_referente="";
		if($referente_id!=NULL){
			$user_referente=User::where('id', '=', $referente_id)->first();
			$name_referente=$user_referente->name." ".$user_referente->last_name;
		}

	

		User::create([
			'name' => $name,
			'last_name' =>$last_name,
			'referente_id' =>$referente_id,
			'name_referente' =>$name_referente,
			'department_id' =>$departamento,
			'city_id' =>$ciudad,
			'zone_id' =>$zona,
			'profesion' =>$profesion,
			'phone1' =>$phone1,
			'phone2' =>$phone2,
			'direccion' =>$direccion,
			'fecha_nacimiento'=>$fecha_nacimiento,
			'have_vehicle' =>$have_vehicle,
			'vehicle_type' =>$vehicle_type,
			'vehicle_plate' =>$vehicle_plate,
			'user_type_id' =>$user_type_id,
			'sector_id' =>$sector,
			'identificacion' => $identificacion,
			'email' => $email,
			'password' => bcrypt($password),
			'password_string' => $password,
			'active_account' => true,

		]);
	    // return redirect('usercreate')->with('adduser', 'La informacion se ha completado correctamente');



		return redirect()->action('UsuarioController@getIndex')->with('adduser', 'La informacion se ha completado correctamente');

	   ///return redirect()->back()->with('adduser', 'La informacion se ha completado correctamente');
	}


	public function postEditUser(UserUpdateRequest $request)
	{
        $id = $request->get('id');

        $usuario = Auth::user();

		$departments= Department::all();
		$zone_types= ZoneType::all();
	    $usertypes;

	    if($usuario->is_admin==true){
	      	$usertypes= UserType::all();
	    }else{
	      	$usertypes=UserType::where('name_user_type', '!=', "Candidato")->get();
	    }

    
     // $users= User::where('id', '!=', $usuario->id)->get();

      $users;
     if($usuario->is_admin==true){
      	$users= User::where('is_admin', '!=', 1)->get();
      }else{
      	$this->UserReferente($usuario->id);
	     if($usuario->is_admin!=true || $usuario->is_super_admin!=true){
	     	 $this->UserReferente[] =$usuario;
	     }
	    
	     $users=$this->UserReferente;
     }

      $user_selected=User::find($id);

	  return view('user.update_user',compact("departments","usertypes","users","zone_types","user_selected"));
	}



	public function postUpdateUser(UserUpdateRequest $request)
	{
        $id = $request->get('id');

        $usuario = Auth::user();



		$name = $request->get('name');
		$last_name = $request->get('last_name');
		$user_type_id = $request->get('user_type_id');
		$identificacion = Input::get('identificacion');
		$direccion = Input::get('direccion');
		$fecha_nacimiento = Input::get('fecha_nacimiento');
		$profesion = Input::get('profesion');
		$referente_id = $request->get('referente_id');
		$sector = $request->get('sector');
		$zona = $request->get('zona');
		$ciudad = $request->get('ciudad');
		$departamento =$request->get('departamento');
		$phone1 = Input::get('phone1');
		$phone2 = Input::get('phone2');
		$have_vehicle = Input::get('have_vehicle');
		$vehicle_type = Input::get('vehicle_type');
		$vehicle_plate = Input::get('vehicle_plate');
		$email = $request->get('email');
		$password = $request->get('password');


		if(($referente_id==NULL || $referente_id=='') && ($usuario->is_admin==false)){
			$referente_id=$usuario->id;
		}else{

			$user_type=UserType::where('id', '=', $user_type_id)->first();
			
			if($user_type->name_user_type!='Candidato'  && $user_type->name_user_type=='Lider' ){
				$validator = $this->userRegisterValidation->validatorCredentials($request->all());
				if ($validator->fails())
				{
					$this->throwValidationException(
						$request, $validator
					);
				}
			}

			if($user_type->name_user_type!='Candidato' ){
				
				$validatorUserType = $this->userRegisterValidation->validatorLiderOrUser($request->all());
				if ($validatorUserType->fails())
				{
					$this->throwValidationException(
						$request, $validatorUserType
					);
				}


			}
			else{

				$referente_id=NULL;
			}

		}

		if($sector==NULL || $sector==''){
			$sector=NULL;
		}

		if($zona==NULL || $zona==''){
			$zona=NULL;
		}


		if($ciudad==NULL || $ciudad==''){
			$ciudad=NULL;
		}


		if($departamento==NULL || $departamento==''){
			$departamento=NULL;
		}

		if($have_vehicle==NULL || $have_vehicle==''){
			$have_vehicle=false;
		}else{
			$have_vehicle=true;
		}

		if($fecha_nacimiento==NULL || $fecha_nacimiento=='' || $fecha_nacimiento==0){
			$fecha_nacimiento=NULL;
		}
		


		


		$name_referente="";
		if($referente_id!=NULL){
			$user_referente=User::where('id', '=', $referente_id)->first();
			$name_referente=$user_referente->name." ".$user_referente->last_name;
		}

		$usuario_update=User::find($id);
	

		
			$usuario_update->name = $name;
			$usuario_update->last_name = $last_name;
			$usuario_update->referente_id = $referente_id;
			$usuario_update->name_referente = $name_referente;
			$usuario_update->department_id = $departamento;
			$usuario_update->city_id = $ciudad;
			$usuario_update->zone_id = $zona;
			$usuario_update->profesion = $profesion;
			$usuario_update->phone1 = $phone1;
			$usuario_update->phone2 = $phone2;
			$usuario_update->direccion = $direccion;
			$usuario_update->fecha_nacimiento = $fecha_nacimiento;
			$usuario_update->have_vehicle = $have_vehicle;
			$usuario_update->vehicle_type = $vehicle_type;
			$usuario_update->vehicle_plate = $vehicle_plate;
			$usuario_update->user_type_id = $user_type_id;
			$usuario_update->sector_id = $sector;
			$usuario_update->identificacion =  $identificacion;
			$usuario_update->email =  $email;
			$usuario_update->password = bcrypt($password);
			$usuario_update->password_string =  $password;
			$usuario_update->active_account = true;



			//return $usuario_update;



			///return $usuario_update;

		$usuario_update->save();

		

        return redirect()->action('UsuarioController@getIndex')->with('updateuser', 'La informacion se ha actualizo correctamente');
       
	}


	public function postDeleteUser(UserUpdateRequest $request)
	{
       $id = $request->get('id');
        // $this->$UserReferente=array();
        //return "Eliminado";

       $userDelete=User::where('id', '=',$id)->first();


        $usuario = Auth::user();

        $this->UserReferente($id);
        $reversed = array_reverse($this->UserReferente);
        foreach ( $reversed  as $item) {

        	$updateUser=User::where('id', '=', $item->id)->first();

        	//Pasan a nombre del referente del usuario a eliminar
        	if($userDelete->referente_id != NULL){
        		$updateUser->referente_id= $userDelete->referente_id;
        		$updateUser->name_referente= $userDelete->name." ".$userDelete->last_name;
        		$updateUser->update();
        	}else{

        	}
        }


        $usuario_delete=User::find($id);
        if($usuario_delete!=null){
        	$usuario_delete->delete();
        }

       //return $reversed;
       // return $this->UserReferenteId;
       
        //$userFunction->delete();
        return redirect()->action('UsuarioController@getIndex')->with('deleteuser', 'La informacion elemino correctamente');
	}


	public  function UserReferente($id)
    {
    	//$userDelete=User::find($id);

    	$usuario = Auth::user();

		$users= User::where('referente_id', '=', $id)->get();
		

    	


    	if($users!=null){
    		foreach ($users as $user) {
    			array_push($this->UserReferenteId,$user->id);
	    	///array_push($this->UserReferente, $userDelete);
	    		$this->UserReferente[] =$user;
	    		$this->UserReferente($user->id);
    		}
    		
    	}
        return  $users;
    }


    public  function UserReferenteList($id)
    {
    	$users= User::join('user_types', 'user_types.id', '=', 'users.user_type_id')
                   ->where('users.referente_id', '=', $id)
                   ->select('users.id', 'users.name', 'users.last_name', 'users.identificacion',
                   	'users.direccion','users.phone1', 'users.phone2', 'users.email',
                   	'user_types.name_user_type')
                   ->get();

    	if($users!=null){

    		foreach ($users as $user) {
    			$this->UserReferenteList[] =$user;
    		    $this->UserReferenteList($user->id);
    		}

    	
    	}
        return  $users;
    }
/*
    public function verificarFotosByAlbum($idalbum)
	{
		$countfotosbyalbum = DB::table('fotos')
		->where('fotos.album_id','=', $idalbum)
		->groupBy('fotos.album_id')->count();
		return  $countfotosbyalbum;

	}*/



	public function postCiudadesByDepartment()
	{
	    $departamento = Input::get('departamento');
	    $ciudades=City::where('department_id', '=', $departamento )->get();
	    $arr['success'] = true;
	    $arr['cities'] =  $ciudades;
    	return json_encode($arr);
	}


	public function postZonasByCiudad()
	{
	    $ciudad = Input::get('ciudad');
	    $zone_type = Input::get('zone_type');


	    $sectoresType=SectorType::where('zone_type_id', '=', $zone_type )->get();

	    $sectorsTipeId=array();

	    foreach ($sectoresType as $sectortype) {
	    	array_push($sectorsTipeId,$sectortype->id);
	    }

	  
	    $zones=Zone::where('city_id', '=', $ciudad )
	    ->whereIn('sector_type_id',$sectorsTipeId)
	    ->get();
	    
	    $arr['success'] = true;
	    $arr['zones'] =  $zones;
    	return json_encode($arr);
	}


	public function postSectoresByZona()
	{
	    $zone = Input::get('zone');
	    $zone_type = Input::get('zone_type');


	    $sectoresType=SectorType::where('zone_type_id', '=', $zone_type )->get();

	    $sectorsTipeId=array();

	    foreach ($sectoresType as $sectortype) {
	    	array_push($sectorsTipeId,$sectortype->id);
	    }

	   
	   
	    $sectors=Sector::where('zone_id', '=', $zone )
	    ->whereIn('sector_type_id',$sectorsTipeId)
	    ->get();
	    
	    $arr['success'] = true;
	    $arr['sectors'] =  $sectors;
	     $arr['zone'] =  $zone;
	      $arr['zone_type'] =  $zone_type;
    	return json_encode($arr);
	}







	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}



	///USUARIOS BY ZONES
	/*---------------------------------------------------------------------------------------------------------*/

	public function getViewUsersByZones()
	{

		$usuario = Auth::user();
		$departments= Department::all();
		$zone_types= ZoneType::all();
	  return view('user.view_users_by_zone', compact("departments","zone_types"));
	}



	public function getQueryUsersByZoneByCity($zone_type_id,$city_id){
			/*$users = Zone::join('sectors', 'sectors.zone_id', '=', 'zones.id')
		           ->join('users', 'users.sector_id', '=', 'sectors.id')
                   ->where('users.referente_id', '=', $usuario->id)
                   ->groupBy('zones.id');*/

        $usuario = Auth::user();
        $this->UserReferenteListByZones($zone_type_id,$city_id,$usuario->id);
        $users= $this->UserReferenteByZones;

        $arr['success'] = true;
	    $arr['users'] =  $users;
    	return json_encode($arr);

      /*  $users = DB::select( DB::raw("SELECT z.name_zone, z.id, z.sector_type_id  
           FROM zones AS z 
           INNER JOIN sectors AS s ON z.id=s.zone_id
           INNER JOIN users AS u ON s.id=u.sector_id
           WHERE u.referente_id=$usuario->id
           GROUP BY z.id
           ORDER BY z.name_zone ASC "));*/


       /* $users = DB::table('zones')
        		    ->join('sectors', 'zones.id', '=', 'sectors.id')
                    ->orderBy('zones.id', 'desc')
                    ->groupBy('zones.id')
                    ->get();*/



       /* $users = DB::table('users')
                     ->select(DB::raw('count(*) as user_count, status'))
                     ->where('status', '<>', 1)
                     ->groupBy('status')
                     ->get();
                  */


                 //  return $users;
	}



	public  function UserReferenteListByZones($zone_type_id,$city_id, $usuario_id)
    {
        $users= User::join('user_types', 'user_types.id', '=', 'users.user_type_id')
                   ->join('sectors', 'users.sector_id', '=', 'sectors.id')
                   ->join('zones', 'sectors.zone_id', '=', 'zones.id')
                   ->join('sector_types', 'zones.sector_type_id', '=', 'sector_types.id')
                   ->where('users.referente_id', '=', $usuario_id)
                   ->where('zones.city_id', '=', $city_id)
                  // ->where('sector_types.zone_type_id', '=', $zone_type_id)
                   ->select('zones.sector_type_id','sector_types.zone_type_id','users.id', 'users.name', 'users.last_name', 'users.identificacion',
                   	'users.direccion','users.phone1', 'users.phone2', 'users.email',
                   	'user_types.name_user_type','zones.name_zone','sector_types.zone_type_id')
                   ->get();


       /* $users = DB::select( DB::raw("SELECT  
           u.id,u.name, u.last_name, u.identificacion,u.direccion,u.phone1,u.phone2,u.email, ut.name_user_type, z.name_zone  FROM users AS u
           INNER JOIN user_types AS ut ON u.user_type_id=ut.id
           INNER JOIN sectors AS s ON u.sector_id=s.id
           INNER JOIN zones AS z ON s.zone_id=s.zone_id
           INNER JOIN sector_types AS st ON z.sector_type_id=st.id
           WHERE z.city_id= $city_id AND st.zone_type_id=$zone_type_id AND u.referente_id=$usuario_id
           GROUP BY  ut.name_user_type,z.name_zone,u.id
           ORDER BY u.id DESC"));*/

    	if($users!=null){
    		foreach ($users as $user) {

    			if($user->zone_type_id==$zone_type_id){
    				$this->UserReferenteByZones[] =$user;
    		
    			}

    			 $this->UserReferenteListByZones($zone_type_id,$city_id,$user->id);
    			
    		}

    	
    	}
        return  $users;
    }


}
