<?php
declare(strict_types = 1);

namespace AppHealer\Http\Controllers;

use Illuminate\Http\Response;

class DashboardController
{

	public function index(): Response
	{
		return response()->view('dashboard');
	}
}
