<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up(): void
	{
		Schema::create('monitor_checks', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('monitor_id');
			$table->boolean('failed')->default(false);
			$table->smallInteger('timeout')->unsigned();
			$table->smallInteger('statuscode')->unsigned();
			$table->timestamp('eventtime')->useCurrent();
			$table->foreign('monitor_id')->references('id')->on('monitors')
			->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('monitor_checks');
	}
};
