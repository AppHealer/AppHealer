<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('monitor_teams', function(Blueprint $table)
		{
			$table->bigInteger('user_id')->unsigned();
			$table->bigInteger('monitor_id')->unsigned();
			$table->primary(['user_id', 'monitor_id']);
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('monitor_id')->references('id')->on('monitors')->onDelete('cascade');
			$table->enum(
				'role',
				array_column(\AppHealer\Enums\MonitorUserRole::cases(), 'value')
			)->default(\AppHealer\Enums\MonitorUserRole::VIEWER);
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('monitor_teams');
	}
};
