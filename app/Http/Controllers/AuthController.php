<?php
declare(strict_types = 1);

namespace AppHealer\Http\Controllers;

use AppHealer\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AuthController
{

	public function loginForm(): Response|RedirectResponse
	{
		if (auth()->user() && auth()->user()->blocked === false) {
			return redirect()->route('dashboard');
		}
		return response()->view('auth.login');
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		$credentials = $request->only('email', 'password');
		if (auth()->attempt($credentials)) {
			$request->session()->regenerate();
			return redirect()->intended(
				route('dashboard')
			);
		}
		return back()->withErrors([
			'email' => __('Bad email or password'),
		]);
	}

	public function logout(): RedirectResponse
	{
		auth()->logout();
		return redirect()->route('login');
	}
}
