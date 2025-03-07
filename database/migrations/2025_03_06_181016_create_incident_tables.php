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
		Schema::create('incidents', function (Blueprint $table) {
			$table->id();
			$table->string('caption');

			$table->unsignedBigInteger('monitor_id');
			$table->foreign('monitor_id')->references('id')->on('monitors')
				->onDelete('cascade');

			$table->unsignedBigInteger('assigned_user_id')->nullable();
			$table->foreign('assigned_user_id')->references('id')->on('users')
				->onDelete('set null');


			$table->datetime('datetime_created')->useCurrent();
			$table->unsignedBigInteger('created_by')->nullable();
			$table->foreign('created_by')->references('id')->on('users')
				->onDelete('set null');

			$table->datetime('datetime_closed')->nullable();
			$table->unsignedBigInteger('closed_by')->nullable();
			$table->foreign('closed_by')->references('id')->on('users')
				->onDelete('set null');
			$table->timestamps();
		});

		Schema::create('incident_comments', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('incident_id');
			$table->foreign('incident_id')->references('id')->on('incidents')
				->onDelete('cascade');


			$table->dateTime('datetime_created')->useCurrent();
			$table->unsignedBigInteger('created_by')->nullable();
			$table->foreign('created_by')->references('id')->on('users')
				->onDelete('set null');
			$table->text('comment');
			$table->timestamps();

		});

		Schema::create('incident_history', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('incident_id');
			$table->foreign('incident_id')->references('id')->on('incidents')
				->onDelete('cascade');
			$table->unsignedBigInteger('assigned_user_id')->nullable();
			$table->foreign('assigned_user_id')->references('id')->on('users')
				->onDelete('set null');

			$table->unsignedBigInteger('prev_assigned_user_id')->nullable();
			$table->foreign('prev_assigned_user_id')->references('id')->on('users')
				->onDelete('set null');

			$table->dateTime('datetime_created¨')->useCurrent();
			$table->unsignedBigInteger('created_by')->nullable();
			$table->foreign('created_by')->references('id')->on('users')
				->onDelete('set null');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{

		Schema::dropIfExists('incident_comments');
		Schema::dropIfExists('incident_history');
		Schema::dropIfExists('incidents');
	}
};
