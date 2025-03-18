<?php
declare(strict_types = 1);

namespace AppHealer\Http\Controllers;

use AppHealer\Http\Requests\UserRequest;
use AppHealer\Models\User;
use AppHealer\Notifications\Users\UserCreated;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UsersController
{

	public function index(): Response
	{
		$users = User::orderBy('name')
		->paginate(10);
		return response()->view(
			'users.list',
			[
				'users' => $users
			]
		);
	}

	public function edit(
		User $user
	): Response
	{
		$data = [];
		parse_str(
			(string)parse_url(
				request()->headers->get('referer'),
				PHP_URL_QUERY
			),
			$data
		);
		return response()->view(
			'users.edit',
			[
				'pagingPage' => $data['page'] ?? 0,
				'user' => $user,
			]
		);
	}

	public function create(
	): Response
	{
		parse_str(
			(string)parse_url(
				request()->headers->get('referer'),
				PHP_URL_QUERY
			),
			$data
		);
		return response()->view(
			'users.edit',
			[
				'pagingPage' => $data['page'] ?? 0,
			]
		);
	}

	public function block(
		User $user,
	): RedirectResponse
	{
		$user->blocked = !$user->blocked;
		$user->save();
		return response()
			->redirectToRoute(
				'users',
				['page' => request()->get('page')]
			)
			->with('message', __('User was locked.'));
	}

	public function delete(
		User $user,
	): RedirectResponse
	{
		$user->delete();
		return response()
			->redirectToRoute(
				'users',
				['page' => request()->get('page')]
			)
			->with('message', __('User was deleted.'));
	}

	public function save(
		User $user
	): RedirectResponse
	{
		app()->make(UserRequest::class);
		$user->fill(request()->all());
		if ($user->id === null) { //new user, set random password
			$user->password = Hash::make(uniqid());
		}
		$message = $user->id === null ? 'User <i>:name</i> created.' : 'User <i>:name</i> updated.';
		$userCreated = $user->id === null;
		$user->save();
		if ($userCreated) {
			$token = Password::createToken($user);
			$user->notify(new UserCreated($token));
		}

		return response()
			->redirectToRoute(
				'users',
				['page' => request()->get('page')]
			)
			->with(
				'message',
				__($message, ['name' => $user->name])
			);
	}
}
