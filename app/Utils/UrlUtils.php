<?php
declare(strict_types=1);

namespace AppHealer\Utils;

class UrlUtils
{

	/**
	 * @param  string[]  $exclude
	 */
	public static function stripFromQueryString(
		string $url,
		array $exclude
	): string
	{
		parse_str($url, $params);
		foreach ($exclude as $param) {
			unset($params[$param]);
		}
		$string = http_build_query($params);
		return '?' . $string;
	}
}
