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
		Schema::table('incidents', function (Blueprint $table) {
			$table->enum(
				'state',
				array_column(\AppHealer\Enums\IncidentState::cases(), 'value')
			)->default(\AppHealer\Enums\IncidentState::NEW->value)->after('assigned_user_id');
		});

		Schema::table('incident_history', function (Blueprint $table) {
			$table->enum(
				'state',
				array_column(\AppHealer\Enums\IncidentState::cases(), 'value')
			)->nullable()->after('incident_id');
			$table->enum(
				'prev_state',
				array_column(\AppHealer\Enums\IncidentState::cases(), 'value')
			)->nullable()->after('state');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('incidents', function (Blueprint $table) {
			$table->dropColumn('state');
		});
		Schema::table('incident_history', function (Blueprint $table) {
			$table->dropColumn('state');
			$table->dropColumn('prev_state');
		});
	}
};
