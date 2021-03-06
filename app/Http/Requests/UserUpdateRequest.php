<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserUpdateRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		
		return true;
		
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'id' => 'required|exists:users,id',
			'name' => 'required',
			'last_name' => 'required',
			'user_type_id' => 'required',
			'departamento' => 'required',
			'ciudad' => 'required',
			'zona' => 'required',
			'sector' => 'required'
		];
	}

}
