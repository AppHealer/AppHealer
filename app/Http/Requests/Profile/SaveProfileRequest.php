<?php
declare(strict_types=1);

namespace AppHealer\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProfileRequest extends FormRequest
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
				Rule::unique('users')->ignore(
					auth()->user()->id
				),
			],
			'name'  => 'required|min:4',
		];
	}
}
