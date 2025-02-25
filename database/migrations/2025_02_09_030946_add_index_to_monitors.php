<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::table('monitor_checks', function (Blueprint $table) {
			$table->index('monitor_id');
			$table->index('eventtime');
			$table->index('failed');
		});
	}

	public function down(): void
	{
		Schema::table('monitor_checks', function (Blueprint $table) {
			$table->dropIndex([
				'monitor_id',
				'eventtime',
				'failed',
			]);
		});
	}
};
