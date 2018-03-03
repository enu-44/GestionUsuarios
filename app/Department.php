<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'departments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','codigodpto','name_department'];

	public function Cities(){
		return $this->hasMany('App\City.php');
	}

}
