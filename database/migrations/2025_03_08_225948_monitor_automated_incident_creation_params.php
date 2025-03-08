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
		Schema::table('monitors', static function (Blueprint $table) {
			$table->integer('incidentCreateAvg')->nullable()->after('interval');
			$table->integer('incidentCreateCount')->nullable()->after('incidentCreateAvg');
			$table->integer('incidentCloseAvg')->nullable()->after('incidentCreateCount');
			$table->integer('incidentCloseCount')->nullable()->after('incidentCloseAvg');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('monitors', static function (Blueprint $table) {
			$table->dropColumn('incident_create_avg');
			$table->dropColumn('incident_create_count');
			$table->dropColumn('incident_close_avg');
			$table->dropColumn('incident_close_count');
		});
	}
};
