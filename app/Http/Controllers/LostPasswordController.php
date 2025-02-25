<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers;

use AppHealer\Http\Requests\Auth\PasswordResetRequest;
use AppHealer\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class LostPasswordController
{

	public function showSendPasswordForm(): Response
	{
		return response()->view('auth.lostpassword');
	}

	public function submitSendPasswordForm(
		Request $request,
	): RedirectResponse
	{
		$status = Password::sendResetLink(
			$request->only('email')
		);

		if ($status === Password::ResetLinkSent) {
			return back()->with([
				'message' => __($status)
			]);
		} else {
			return back()->withErrors([
				'email' => __($status)
			]);
		}
	}

	public function showPasswordResetForm(string $resettoken): Response
	{
		return response()->view(
			'auth.passwordreset',
			[
				'resettoken' => $resettoken
			]
		);
	}

	public function submitPasswordResetForm(
		PasswordResetRequest $request
	): RedirectResponse
	{
		$status = $this->resetPasswordAndGetStatusCode($request);

		if ($status === Password::PasswordReset) {
			return redirect()
				->route('login')
				->with('message', __($status));
		} else {
			return back()->withErrors([
				'errors' => [__($status)]
			]);
		}
	}

	protected function resetPasswordAndGetStatusCode(PasswordResetRequest $request): mixed
	{
		return Password::reset(
			[
				'email' => $request->get('email'),
				'password' => $request->get('password'),
				'token' => $request->get('resettoken'),
			],
			function (User $user, string $password): void {
				$user->forceFill([
					'password' => Hash::make($password)
				]);
				$user->save();
			}
		);
	}
}
