<?php
declare(strict_types=1);

namespace AppHealer\Http\Requests\Incidents;

use Illuminate\Foundation\Http\FormRequest;

class AddCommentRequest extends FormRequest
{

	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		$this->redirect = url()->previous() . '#commentForm';

		return [
			'comment'  => 'required|min:40',

		];
	}
}
