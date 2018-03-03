<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'cities';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','name_city','department_id'];

	public function Zones(){
		return $this->hasMany('App\Zone.php');
	}

	public function propietarioDepartment(){

		return $this->belongsTo('App\Department');
	}




}
