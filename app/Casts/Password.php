<?php
// phpcs:disable Generic.CodeAnalysis.UnusedFunctionParameter
declare(strict_types=1);

namespace AppHealer\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Password implements CastsAttributes
{

	/**
	 * Cast the given value.
	 *
	 * @param  array<string, mixed>  $attributes
	 */
	public function get(Model $model, string $key, mixed $value, array $attributes): ?string
	{
		return $value ? Crypt::decrypt($value) : null;
	}

	/**
	 * Prepare the given value for storage.
	 *
	 * @param  array<string, mixed>  $attributes
	 */
	public function set(Model $model, string $key, mixed $value, array $attributes): ?string
	{
		return $value ? Crypt::encrypt($value) : null;
	}
}
