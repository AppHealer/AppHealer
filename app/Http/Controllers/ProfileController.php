<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers;

use AppHealer\Http\Requests\Profile\ChangePasswordRequest;
use AppHealer\Http\Requests\Profile\SaveProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class ProfileController
{

	public function changePassword(): Response
	{
		return response()->view('profile.changePassword');
	}

	public function loginHistory(): Response
	{
		$history = auth()->user()
			->loginAuditLog()->paginate(10);
		return response()->view(
			'profile.loginHistory',
			['logins' => $history]
		);
	}

	public function changePasswordSubmit(
		ChangePasswordRequest $request
	): RedirectResponse
	{
		auth()->user()->password = Hash::make(
			$request->get('newPassword')
		);
		auth()->user()->save();
		return redirect()
			->route('profile.changePassword')
			->with(
				'message',
				'Your password has been changed.'
			);
	}

	public function view(): Response
	{
		return response()->view(
			'profile.view',
			['profile' => auth()->user()]
		);
	}

	public function edit(): Response
	{
		return response()->view(
			'profile.edit',
			['profile' => auth()->user()]
		);
	}

	public function save(
		SaveProfileRequest $request
	): RedirectResponse
	{
		auth()->user()->fill($request->all());
		auth()->user()->save();

		return response()
			->redirectToRoute('profile.view')
			->with(
				'message',
				__('Your profile has been updated!')
			);
	}
}
