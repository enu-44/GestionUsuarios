<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model {

	//

	//

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sectors';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','name_sector','description_sector','zone_id','sector_type_id','latitud_sector','longitud_sector'];

	public function Users(){
		return $this->hasMany('App\User.php');
	}



	public function propietarioZone(){

		return $this->belongsTo('App\Zone');
	}

	public function propietarioTipeSector(){

		return $this->belongsTo('App\SectorType');
	}

}
