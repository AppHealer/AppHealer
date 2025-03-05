<?php
declare(strict_types=1);

namespace AppHealer\Console\Commands\QA;

use Illuminate\Console\Command;

class QaPhpCs extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'apphealer:qa:phpcs';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run PHP CodeSniffer';

	/**
	 * Execute the console command.
	 */
	public function handle(): void
	{
		$rslt = shell_exec('./vendor/bin/phpcs --standard=./ruleset.xml  app');
		echo $rslt;
	}
}
