<?php
declare(strict_types = 1);

namespace AppHealer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonitorRequest extends FormRequest
{
	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			'endpoint' => 'required|url:http,https',
			'incidentCloseAvg' => 'nullable|integer|min:0|max:300000',
			'incidentCloseCount' => 'nullable|integer|min:0|max:100',
			'incidentCreateAvg' => 'nullable|integer|min:0|max:300000',
			'incidentCreateCount' => 'nullable|integer|min:0|max:100',
			'name'  => 'required|min:4',
			'timeout' => 'required|integer|min:1|max:60',
		];
	}
}
