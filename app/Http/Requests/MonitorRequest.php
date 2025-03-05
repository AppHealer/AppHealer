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
			'name'  => 'required|min:4',
			'timeout' => 'required|integer|min:1|max:60',
		];
	}
}
