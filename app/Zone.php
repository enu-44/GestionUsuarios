<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model {

	//

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'zones';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','name_zone','description_zone','sector_type_id','city_id','latitud_zone','longitud_zone'];

	public function Sectors(){
		return $this->hasMany('App\Sector.php');
	}



	public function propietarioCiudad(){

		return $this->belongsTo('App\City');
	}



	public function propietarioTipeSector(){

		return $this->belongsTo('App\SectorType');
	}

}
