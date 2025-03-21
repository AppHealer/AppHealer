<?php
declare(strict_types=1);

namespace AppHealer\Console\Commands\QA;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class QaAllCommand extends Command
{

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'apphealer:qa';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run whole QA pipeline';

	/**
	 * Execute the console command.
	 */
	public function handle(): void
	{
		Artisan::call('apphealer:qa:phpcs');
		Artisan::call('apphealer:qa:phpstan');
	}
}
