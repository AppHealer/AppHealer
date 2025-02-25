<?php
declare(strict_types = 1);

namespace AppHealer\Http\Requests\Installation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUser extends FormRequest
{
	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			'email' => [
				'required',
				'email',
				Rule::unique('users')
					->ignore($this->user?->id),
			],
			'name'  => 'required|min:4',
			'password' => 'required|min:8|confirmed',
		];
	}
}
