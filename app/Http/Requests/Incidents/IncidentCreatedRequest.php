<?php
declare(strict_types=1);

namespace AppHealer\Http\Requests\Incidents;

use Illuminate\Foundation\Http\FormRequest;

class IncidentCreatedRequest extends FormRequest
{
	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			'caption'  => 'required|min:6',
			'monitor_id' => 'required|integer|exists:monitors,id',
		];
	}
}
