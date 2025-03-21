<?php
declare(strict_types=1);

namespace AppHealer\Console\Commands\QA;

use Illuminate\Console\Command;

class QaPhpStan extends Command
{

	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'apphealer:qa:phpstan';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run PHPStan';

	/**
	 * Execute the console command.
	 */
	public function handle(): void
	{
		$rslt = shell_exec('./vendor/bin/phpstan --memory-limit=1G analyse app');
		echo $rslt;
	}
}
