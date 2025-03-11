<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers;

use AppHealer\Enums\IncidentState;
use AppHealer\Http\Requests\Incidents\AddCommentRequest;
use AppHealer\Http\Requests\Incidents\IncidentCreatedRequest;
use AppHealer\Models\Incident;
use AppHealer\Models\IncidentComment;
use AppHealer\Models\IncidentHistory;
use AppHealer\Models\Monitor;
use AppHealer\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class IncidentController
{

	public function list(): Response
	{
		$incidents = Incident::query()
			->orderBy('created_at', 'desc');
		$this->applySearchFilter($incidents);

		return response()->view(
			'incidents.list',
			[
				'incidents' => $incidents->paginate(10),
				'monitors' => Monitor::query()->whereHas('incidents')->get(),
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
			->redirectTo(
				$this->getRouteToDetail($incident)
			)
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
		if ($incident->isClosed()) {
			return $this->redirectWithAlreadyClosedMessage($incident);
		}
		$comment = new IncidentComment();
		$comment->fill($request->all());
		$comment->createdBy()->associate(auth()->user());
		$incident->comments()->save($comment);
		return response()->redirectTo(
			$this->getRouteToDetail($incident)
		)->with('message', __('Comment successfully added'));
	}

	public function assign(
		Incident $incident,
		User $user
	): RedirectResponse
	{
		if ($incident->isClosed()) {
			return $this->redirectWithAlreadyClosedMessage($incident);
		}
		$history = new IncidentHistory();
		$history->incident()->associate($incident);
		$history->createdBy()->associate(auth()->user());
		$history->assignedUser()->associate($user);
		$history->prevAssignedUser()->associate($incident->assignedTo);
		$history->save();
		$incident->assignedTo()->associate($user);
		$incident->save();
		return response()->redirectTo(
			$this->getRouteToDetail($incident)
		)->with(
			'message',
			sprintf(__('Task was assigned to %s'), $user->name)
		);
	}

	public function changeState(
		Incident $incident,
		IncidentState $state
	): RedirectResponse
	{
		if ($incident->isClosed()) {
			return $this->redirectWithAlreadyClosedMessage($incident);
		}
		$history = new IncidentHistory();
		$history->incident()->associate($incident);
		$history->createdBy()->associate(auth()->user());
		$history->state = $state;
		$history->prev_state = $incident->state; //phpcs:disable Squiz.NamingConventions.ValidVariableName
		$history->save();
		$incident->state = $state;
		if ($state === IncidentState::CLOSED) {
			$incident->closedBy()->associate(auth()->user());
			$incident->datetime_closed = now();  //phpcs:disable Squiz.NamingConventions.ValidVariableName
		}
		$incident->save();
		return response()->redirectTo(
			$this->getRouteToDetail($incident)
		)->with(
			'message',
			$state == IncidentState::CLOSED
				? __('Incident has been closed')
				: sprintf(__('Status was changed to %s'), $state->value)
		);
	}

	protected function getRouteToDetail(Incident $incident): string
	{
		return route(
			'incidents.detail',
			[
				'incident' => $incident,
			]
		);
	}

	protected function redirectWithAlreadyClosedMessage(Incident $incident): RedirectResponse
	{
		return response()->redirectToRoute('incidents.detail', $incident)
			->with(
				'error',
				__('Incident already closed')
			);
	}

	protected function applySearchFilter(Builder $query): void
	{
		if (request('monitor')) {
			$query->where('monitor_id', request('monitor'));
		}
		if (request('dateFrom')) {
			$query->where( 'created_at', '>=', request('dateFrom')
			);
		}

		if (request('dateTo')) {
			$query->where('created_at', '<=', request('dateTo'));
		}

		$this->applySearchFilterState($query);

	}

	protected function applySearchFilterState(Builder $query): void
	{
		switch (request('state')) {
			case 'new':
				$query->where('state', IncidentState::NEW);
				break;
			case 'workingon':
				$query->whereIn(
					'state',
					[
						IncidentState::CONFIRMED,
						IncidentState::INVESTIGATING,
						IncidentState::FIXING,
						IncidentState::MONITORING,
					]
				);
				break;
			case 'closed':
				$query->where('state', IncidentState::CLOSED);
				break;
			case 'unclosed':
			default:
				$query->whereNot('state', IncidentState::CLOSED);
		}

	}
}
