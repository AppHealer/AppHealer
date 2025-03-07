<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers;

use AppHealer\Http\Requests\Incidents\AddCommentRequest;
use AppHealer\Http\Requests\Incidents\IncidentCreatedRequest;
use AppHealer\Models\Incident;
use AppHealer\Models\IncidentComment;
use AppHealer\Models\IncidentHistory;
use AppHealer\Models\Monitor;
use AppHealer\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class IncidentController
{
	public function list(): Response
	{
		return response()->view(
			'incidents.list',
			[
				'incidents' => Incident::query()->orderBy('created_at', 'desc')->get(),
			]
		);
	}

	public function create(): Response
	{
		return response()->view(
			'incidents.create',
			[
				'monitors' => Monitor::query()->orderBy('name')->get(),
				'users' => User::query()->orderBy('name')->get(),
			]
		);
	}

	public function save(
		IncidentCreatedRequest $request
	): RedirectResponse
	{
		$incident = new Incident();
		$incident->fill(
			$request->all()
		);
		$incident->createdBy()->associate(auth()->user());
		if (request('assigned_user')) {
			$incident->assignedTo()->associate(
				User::where('id', request('assigned_user'))->first()
			);
		}
		$incident->save();
		if (request('comment')) {
			$comment = new IncidentComment(['comment' => request('comment')]);
			$comment->createdBy()->associate(auth()->user());
			$incident->comments()->save($comment);
		}
		return response()
			->redirectToRoute('incidents')
			->with(
				'message',
				__('Incident successfully created')
			);
	}

	public function detail(Incident $incident): Response
	{
		return response()->view(
			'incidents.detail',
			[
				'incident' => $incident,
				'users' => User::query()->orderBy('name')->get(),
			]
		);
	}

	public function comment(
		Incident $incident,
		AddCommentRequest $request
	): RedirectResponse
	{
		$comment = new IncidentComment();
		$comment->fill($request->all());
		$comment->createdBy()->associate(auth()->user());
		$incident->comments()->save($comment);
		return response()->redirectTo(
			route(
				'incidents.detail',
				[
					'incident' => $incident,
				]
			) . '#commentForm'
		)->with('message', __('Comment successfully added'));
	}

	public function assign(
		Incident $incident,
		User $user
	): RedirectResponse
	{
		$history = new IncidentHistory();
		$history->incident()->associate($incident);
		$history->createdBy()->associate(auth()->user());
		$history->assignedUser()->associate($user);
		$history->prevAssignedUser()->associate($incident->assignedTo);
		$history->save();
		$incident->assignedTo()->associate($user);
		$incident->save();
		return response()->redirectTo(
			route(
				'incidents.detail',
				[
					'incident' => $incident,
				]
			) . '#commentForm'
		)->with(
			'message',
			sprintf(__('Task was assigned to %s'), $user->name)
		);
	}
}
