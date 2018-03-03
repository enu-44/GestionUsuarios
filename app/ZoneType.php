<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ZoneType extends Model {

	
		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'zone_types';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','name_zone_type'];

	public function Zonas(){
		return $this->hasMany('App\SectorType.php');
	}

}
