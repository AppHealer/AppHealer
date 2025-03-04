<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers\Errors;

use Symfony\Component\HttpFoundation\Response;

class NotFoundController
{
	public function pageNotFound(): Response
	{
		return response()
			->view('errors.404')
			->setStatusCode(Response::HTTP_NOT_FOUND);
	}

	public function monitorNotFound(): Response
	{
		return response()
			->redirectToRoute('monitors')
			->with(
				'error',
				__('Unknown monitor ID in url.')
			);
	}
}
