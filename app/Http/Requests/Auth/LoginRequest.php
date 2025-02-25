<?php
declare(strict_types = 1);

namespace AppHealer\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			'email'    => 'required|email',
			'password' => 'required',
		];
	}
}
