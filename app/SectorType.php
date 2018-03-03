<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SectorType extends Model {

	//
		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sector_types';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','name_sector_type','zone_type_id'];

	public function Sectors(){
		return $this->hasMany('App\Sector.php');
	}

	public function Zonas(){
		return $this->hasMany('App\Zone.php');
	}


	public function propietarioZoneType(){
		return $this->belongsTo('App\ZoneType.php');
	}
}
