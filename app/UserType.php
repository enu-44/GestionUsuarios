<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model {

		/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_types';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','name_user_type'];

	public function Users(){
		return $this->hasMany('App\User.php');
	}

}
