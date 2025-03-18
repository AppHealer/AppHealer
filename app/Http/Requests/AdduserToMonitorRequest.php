<?php
declare(strict_types=1);

namespace AppHealer\Http\Requests;

use AppHealer\Enums\MonitorUserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdduserToMonitorRequest extends FormRequest
{

	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			'role' => [
				'required',
				Rule::enum(MonitorUserRole::class)
			],
			'user' => 'required|exists:users,id',
		];
	}
}
