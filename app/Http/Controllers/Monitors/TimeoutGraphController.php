<?php
declare(strict_types=1);

namespace AppHealer\Http\Controllers\Monitors;

use AppHealer\Models\Monitor;
use Illuminate\Http\Response;

class TimeoutGraphController
{

	protected const IMAGE_HEIGHT = 40;
	protected const IMAGE_WIDTH = 100;
	protected const THICKNESS = 2;

	public function render(
		Monitor $monitor
	): Response
	{
		$data = $this->getData($monitor);
		$content = $this->createImage(
			$data,
			count($data) !== 0 ? (int)min($data) : 0,
			count($data) !== 0 ? (int)max($data) : 0
		);
		return response(
			$content,
			200,
			['Content-Type' => 'image/jpeg']
		);
	}

	/**
	 * @param  float[]  $data
	 *
	 */
	protected function createImage(
		array $data,
		int $min,
		int $max
	): string
	{
		$image = imagecreatetruecolor(self::IMAGE_WIDTH, self::IMAGE_HEIGHT);
		imagefill($image, 0, 0, imagecolorallocate($image, 255, 255, 255));
		$prev = null;
		$scale = (self::IMAGE_HEIGHT - 10) / max($max - $min, 1);
		$step = (int)(self::IMAGE_WIDTH / count($data));
		$color = imagecolorallocate($image, 31, 207, 207);
		imagesetthickness($image, self::THICKNESS);
		foreach ($data as $x => $value) {
			$calculated = (int)(self::IMAGE_HEIGHT - (($value - $min) * $scale)) - 10;
			if ($prev !== null) {
				imageline(
					$image,
					(int)$x * $step,
					$prev,
					(int)($x + 1) * $step,
					$calculated,
					$color
				);
			}
			$prev = $calculated;
		}
		$tmpfile = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
		imagejpeg($image, $tmpfile, 100);
		imagedestroy($image);
		return (string)file_get_contents($tmpfile);
	}

	/**
	 * @return float[]
	 */
	protected function getData(
		Monitor $monitor,
	): array
	{
		$data = $monitor->checks()
			->latest()
			->take(25)
			->get()
			->pluck('timeout')
			->toArray();
		return array_reverse($data);
	}
}
