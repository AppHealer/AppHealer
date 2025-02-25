<?php
declare(strict_types=1);

namespace AppHealer\DTOs;

class CheckStateDTO
{
	public function __construct(
		protected int $index = 0,
		protected string $label = '',
		protected float $avg = 0,
		protected int $min = 0,
		protected int $max = 0,
		protected int $total = 0,
		protected int $failed = 0,
	)
	{
	}

	public function getAvg(): float
	{
		return $this->avg;
	}

	public function getMin(): float
	{
		return $this->min;
	}

	public function getMax(): float
	{
		return $this->max;
	}

	public function getLabel(): string
	{
		return $this->label;
	}

	public function getIndex(): int
	{
		return $this->index;
	}

	public function getTotal(): int
	{
		return $this->total;
	}

	public function getFailed(): int
	{
		return $this->failed;
	}

	public function getOk(): int
	{
		return $this->getTotal() - $this->getFailed();
	}
}
