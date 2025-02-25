<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

	public function up(): void
	{
		Schema::create('monitors', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('endpoint');
			$table->tinyInteger('timeout')->unsigned();
			$table->smallInteger('interval')->unsigned();
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('monitors');
	}
};
