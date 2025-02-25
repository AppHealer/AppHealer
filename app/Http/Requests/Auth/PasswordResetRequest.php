<?php
declare(strict_types=1);

namespace AppHealer\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{

	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			'password' => 'required|min:8|confirmed',
		];
	}
}
