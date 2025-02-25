<?php
declare(strict_types=1);

namespace AppHealer\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
{
	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		//phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter
		return [
			'currentPassword' => ['required', function ($attribute, $value, $fail) {
				if (
					!Hash::check(
						$value,
						auth()->user()->password
					)
				) {
					return $fail(
						__('The current password is incorrect.')
					);
				}
			}],
			'newPassword' => 'required|min:8|confirmed',
		];
		//phpcs:enable
	}
}
