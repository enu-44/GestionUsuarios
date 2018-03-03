<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model {

	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'perfiles';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['id','nombreperfil','descripcion_perfil', 'fechanacimiento','path', 'user_id'];

	public function propietarioUsuario(){
		return $this->belongsTo('App\User');
	}
   

}
