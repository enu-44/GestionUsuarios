<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Zone;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','last_name',
	 'referente_id','name_referente',
	 'department_id', 'city_id','zone_id','name_city',
	 'identificacion', 'profesion','phone1','phone2',
	 'direccion','fecha_nacimiento',
	 'have_vehicle','vehicle_type','vehicle_plate',
	 'email', 'password','password_string','user_type_id','sector_id','active_account','is_admin','is_super_admin'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	protected $hidden = ['password', 'remember_token'];


	public function propietarioUserType(){

		return $this->belongsTo('App\UserType');
	}

	public function propietarioSector(){
		return $this->belongsTo('App\Sector');
	}

	public function Perfiles(){
		return $this->hasMany('App\Perfil.php');
	}



	//Methods
	public function zoneTypeId($idzone)
	{
		$zone = Zone::join('sector_types', 'sector_types.id', '=', 'zones.sector_type_id')
		->join('zone_types', 'zone_types.id', '=', 'sector_types.zone_type_id')
		->where('zones.id','=', $idzone)
		->select('zone_types.id')
		->first();

		return  $zone->id;
	}


	//Methods
	public function vericateCountHaveReferentes($user_id)
	{
		$count_referentes = User::where('referente_id', '=', $user_id)->count();
		return  $count_referentes;
	}
}
