<?php namespace App\Http\Validation;

use App\User;
use Validator;


class UserRegisterValidation  {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validatorLiderOrUser(array $data)
	{
		return Validator::make($data, [
			'referente_id' => 'required|max:255',
		]);
	}

	public function validatorCredentials(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}
}
