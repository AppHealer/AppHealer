<?php
declare(strict_types = 1);

namespace AppHealer\Http\Requests\Installation;

use Illuminate\Foundation\Http\FormRequest;

class SaveEnvRequest extends FormRequest
{
	/**
	 * @return string[]
	 */
	public function rules(): array
	{
		return [
			'appurl' => 'url:http,https',
			'smtpHost' => 'required',
			'smtpPassword' => 'required',
			'smtpPort'  => 'required',
			'smtpSender' => 'required|email',
			'smtpUser'  => 'required',
		];
	}
}
