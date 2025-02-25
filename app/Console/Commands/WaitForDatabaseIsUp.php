<?php
declare(strict_types=1);

namespace AppHealer\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class WaitForDatabaseIsUp extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'apphealer:utils:waitfordb';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Wait until database is up';

	/**
	 * Execute the console command.
	 */
	public function handle(): void
	{
		$retry = 120;
		while (true) {
			try {
				$result = DB::query('SELECT TRUE;');
				return;
			} catch (\Exception $e) {
				if ($retry === 0) {
					throw $e;
				}
				$retry--;
				sleep(1);
			}
		}

	}
}
