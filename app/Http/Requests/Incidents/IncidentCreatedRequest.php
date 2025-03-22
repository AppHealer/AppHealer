<?php
declare(strict_types=1);

namespace AppHealer\Http\Requests\Incidents;

use AppHealer\Enums\GlobalPrivilegesAction;
use AppHealer\Enums\GlobalPrivilegesGroup;
use AppHealer\Models\Monitor;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IncidentCreatedRequest extends FormRequest
{

	/**
	 * @return mixed[]
	 */
	public function rules(): array
	{
		return [
			'caption'  => 'required|min:6',
			'monitor_id' => [
				'exists:monitors,id',
				'integer',
				Rule::requiredIf(request('monitor') === null),
				//phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
				function (string $attribute, mixed $value, Closure $fail): void {
					if (
						!auth()->user()->admin
						&& !auth()->user()->hasGlobalPrivilege(
							GlobalPrivilegesGroup::MONITORS,
							GlobalPrivilegesAction::INCIDENT_CREATE
						)
						&& !auth()->user()->getRoleInMonitor(
							Monitor::find($value)
						)?->canCreateIncident()
					)
					$fail("You haven't enough privileges to create incident.");
				},
			],
		];
	}
}
