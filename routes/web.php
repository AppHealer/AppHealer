<?php

use AppHealer\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'isNotLocked', 'installed'])->group(function() {
	Route::get('/', [\AppHealer\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

	Route::get('/users', [\AppHealer\Http\Controllers\UsersController::class, 'index'])->name('users');
	Route::get('/users/list', [\AppHealer\Http\Controllers\UsersController::class, 'list'])->name('users.list');
	Route::get('/users/create', [\AppHealer\Http\Controllers\UsersController::class, 'create'])->name('users.create');
	Route::post('/users/save', [\AppHealer\Http\Controllers\UsersController::class, 'save'])->name('users.edit.save.new');
	Route::get('/users/missing', [\AppHealer\Http\Controllers\Errors\NotFoundController::class, 'userNotFound'])->name('users.missing');
	Route::middleware('isNotMe')->group(function() {
		Route::get('/users/{user}/block',[\AppHealer\Http\Controllers\UsersController::class, 'block'])->name('users.block')->missing(function () {return redirect(route('users.missing'));});
		Route::get('/users/{user}/delete',[\AppHealer\Http\Controllers\UsersController::class, 'delete'])->name('users.delete')->missing(function () {return redirect(route('users.missing'));});
	});
	Route::post('/users/{user}', [\AppHealer\Http\Controllers\UsersController::class, 'save'])->name('users.edit.save')->missing(function(){return redirect(route('users.missing'));});
	Route::get('/users/{user}', [\AppHealer\Http\Controllers\UsersController::class, 'edit'])->name('users.edit')->missing(function(){return redirect(route('users.missing'));});

	Route::get('/profile/password', [\AppHealer\Http\Controllers\ProfileController::class, 'changePassword'])->name('profile.changePassword');
	Route::post('/profile/password', [\AppHealer\Http\Controllers\ProfileController::class, 'changePasswordSubmit'])->name('profile.changePassword.submit');
	Route::get('/profile', [\AppHealer\Http\Controllers\ProfileController::class, 'view'])->name('profile.view');
	Route::get('/profile/edit', [\AppHealer\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
	Route::post('/profile/edit', [\AppHealer\Http\Controllers\ProfileController::class, 'save'])->name('profile.edit.submit');
	Route::get('/profile/login-history', [\AppHealer\Http\Controllers\ProfileController::class, 'loginHistory'])->name('profile.loginHistory');

	Route::get('/monitors', [\AppHealer\Http\Controllers\Monitors\ListController::class, 'index'])->name('monitors');
	Route::get('/monitors/list', [\AppHealer\Http\Controllers\Monitors\ListController::class, 'list'])->name('monitors.list');
	Route::get('/monitors/{monitor}/timeout', [\AppHealer\Http\Controllers\Monitors\TimeoutGraphController::class, 'render'])->name('monitors.list.timeout.graph');

	Route::get('/monitors/missing', [\AppHealer\Http\Controllers\Errors\NotFoundController::class, 'monitorNotFound'])->name('monitors.missing');

	Route::get('/monitors/create', [\AppHealer\Http\Controllers\Monitors\EditController::class, 'create'])->name('monitors.create');
	Route::get('/monitors/{monitor}/edit', [\AppHealer\Http\Controllers\Monitors\EditController::class, 'edit'])->name('monitors.edit')->missing(function(){return redirect(route('monitors.missing'));});
	Route::post('/monitors/create', [\AppHealer\Http\Controllers\Monitors\EditController::class, 'save'])->name('monitors.edit.save.new');
	Route::post('/monitors/{monitor}/edit', [\AppHealer\Http\Controllers\Monitors\EditController::class, 'save'])->name('monitors.edit.save')->missing(function(){return redirect(route('monitors.missing'));});
	Route::get('/monitors/{monitor}/schedule', [\AppHealer\Http\Controllers\Monitors\DetailController::class, 'schedule'])->name('monitors.schedule')->missing(function(){return redirect(route('monitors.missing'));});
	Route::get('/monitors/{monitor}', [\AppHealer\Http\Controllers\Monitors\DetailController::class, 'detail'])->name('monitors.detail')->missing(function(){return redirect(route('monitors.missing'));});

	Route::get('/monitors/{monitor}/team', [\AppHealer\Http\Controllers\Monitors\TeamController::class, 'list'])->name('monitors.team')->missing(function(){return redirect(route('monitors.missing'));});
	Route::get('/monitors/{monitor}/team/add', [\AppHealer\Http\Controllers\Monitors\TeamController::class, 'add'])->name('monitors.team.add')->missing(function(){return redirect(route('monitors.missing'));});
	Route::post('/monitors/{monitor}/team/add', [\AppHealer\Http\Controllers\Monitors\TeamController::class, 'addSubmit'])->name('monitors.team.add.submit')->missing(function(){return redirect(route('monitors.missing'));});

	Route::middleware('isNotMe')->group(function(){
		Route::get('/monitors/{monitor}/team/remove/{user}', [\AppHealer\Http\Controllers\Monitors\TeamController::class, 'removeFromTeam'])->name('monitors.team.remove')->missing(function(){return redirect(route('monitors.missing'));});
		Route::get('/monitors/{monitor}/team/{user}/{role}', [\AppHealer\Http\Controllers\Monitors\TeamController::class, 'assignRole'])->name('monitors.team.assign')->missing(function(){return redirect(route('monitors.missing'));});
	});


	Route::get('/dashboard/lastLogins', [\AppHealer\Http\Controllers\Dashboard\LastLoginsController::class, 'index'])->name('dashboard.lastLogins');
	Route::get('/dashboard/monitors/failed/{hours}', [\AppHealer\Http\Controllers\Dashboard\MonitorStatsController::class, 'failed'])->name('dashboard.monitors.failed');
	Route::get('/dashboard/monitors/slow/{hours}', [\AppHealer\Http\Controllers\Dashboard\MonitorStatsController::class, 'slow'])->name('dashboard.monitors.slow');


	Route::get('/incidents', [\AppHealer\Http\Controllers\IncidentController::class, 'list'])->name('incidents');
	Route::get('/incidents/create', [\AppHealer\Http\Controllers\IncidentController::class, 'create'])->name('incidents.create');
	Route::post('/incidents/create', [\AppHealer\Http\Controllers\IncidentController::class, 'save'])->name('incidents.create.submit');
	Route::get('/incidents/{incident}', [\AppHealer\Http\Controllers\IncidentController::class, 'detail'])->name('incidents.detail');
	Route::post('/incidents/{incident}/comment', [\AppHealer\Http\Controllers\IncidentController::class, 'comment'])->name('incidents.comments.submit');
	Route::get('/incidents/{incident}/assign/{user}', [\AppHealer\Http\Controllers\IncidentController::class, 'assign'])->name('incidents.assign');
	Route::get('/incidents/{incident}/change-status/{state}', [\AppHealer\Http\Controllers\IncidentController::class, 'changeState'])->name('incidents.change-state');

	Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
	Route::fallback([\AppHealer\Http\Controllers\Errors\NotFoundController::class, 'pageNotFound']);
});


Route::middleware(['guest', 'installed'])->group(function() {
	Route::get('login', [AuthController::class, 'loginForm'])->name('login');
	Route::post('login', [AuthController::class, 'login'])->name('login.post');
	Route::get('lostpassword', [\AppHealer\Http\Controllers\LostPasswordController::class, 'showSendPasswordForm'])->name('passwordreset');
	Route::post('lostpassword', [\AppHealer\Http\Controllers\LostPasswordController::class, 'submitSendPasswordForm'])->name('passwordreset.submit');
	Route::get('password-reset/{resettoken}', [\AppHealer\Http\Controllers\LostPasswordController::class, 'showPasswordResetForm'])->name('passwordreset.reset');
	Route::post('password-reset/{resettoken}', [\AppHealer\Http\Controllers\LostPasswordController::class, 'submitPasswordResetForm'])->name('passwordreset.reset.submit');
});

Route::middleware(['guest'])->group(function() {
	Route::get('installation', [\AppHealer\Http\Controllers\InstallationController::class, 'index'])->name('installation');
	Route::post('installation/env', [\AppHealer\Http\Controllers\InstallationController::class, 'saveEnv'])->name('installation.save.env');
	Route::post('installation/user', [\AppHealer\Http\Controllers\InstallationController::class, 'createUser'])->name('installation.create.user');
});

