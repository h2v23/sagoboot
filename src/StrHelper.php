<?php
/**
 * @author @haihv433
 * @package SagoBoot | The mini-framework for scalable PHP application
 * @see https://github.com/haihv433/sagoboot
 */

namespace SagoBoot;


use SagoBoot\Support\Helper;

/**
 * Interface StrHelper
 * @package SagoBoot
 */
interface StrHelper extends Helper

{
	/**
	 * Convert a value to camel case.
	 *
	 * @param  string $value
	 *
	 * @return string
	 */
	public function camel($value);

	/**
	 * Determine if a given string contains a given substring.
	 *
	 * @param  string $haystack - the string to search in
	 * @param  string|array $needles
	 *
	 * @return bool
	 */
	public function contains($haystack, $needles);

	/**
	 * Determine if a given string ends with a given substring.
	 *
	 * @param  string $haystack
	 * @param  string|array $needles
	 *
	 * @return bool
	 */
	public function endsWith($haystack, $needles);

	/**
	 * Cap a string with a single instance of a given value.
	 *
	 * @param  string $value
	 * @param  string $cap
	 *
	 * @return string
	 */
	public function finish($value, $cap);

	/**
	 * Determine if a given string matches a given pattern.
	 *
	 * @param  string $pattern
	 * @param  string $value
	 *
	 * @return bool
	 */
	public function is($pattern, $value);
	/**
	 * Return the length of the given string.
	 *
	 * @param  string $value
	 *
	 * @return int
	 */
	public function length($value);

	/**
	 * Limit the number of characters in a string.
	 *
	 * @param  string $value
	 * @param  int $limit
	 * @param  string $end
	 *
	 * @return string
	 */
	public function limit($value, $limit = 100, $end = '...');

	/**
	 * Convert the given string to lower-case.
	 *
	 * @param  string $value
	 *
	 * @return string
	 */
	public function lower($value);

	/**
	 * Generate a "random" alpha-numeric string.
	 *
	 * Should not be considered sufficient for cryptography, etc.
	 *
	 * @param  int $length
	 *
	 * @return string
	 */
	public function quickRandom($length = 16);

	/**
	 * Convert the given string to upper-case.
	 *
	 * @param  string $value
	 *
	 * @return string
	 */
	public function upper($value);

	/**
	 * Convert a string to snake case.
	 *
	 * @param  string $value
	 * @param  string $delimiter
	 *
	 * @return string
	 */
	public function snake($value, $delimiter = '_');

	/**
	 * Determine if a given string starts with a given substring.
	 *
	 * @param  string $haystack
	 * @param  string|array $needles
	 *
	 * @return bool
	 */
	public function startsWith($haystack, $needles);

	/**
	 * Convert a value to studly caps case.
	 *
	 * @param  string $value
	 *
	 * @return string
	 */
	public function studly($value);

    /**
     * @param $atts
     * @return mixed
     */
	public function buildQueryString($atts);

    /**
     * @param $str
     * @param bool $lower
     * @return mixed
     */
	public function slugify($str, $lower = true);

    /**
     * Convert string to object
     * @param $value
     * @return mixed
     */
	public function convert($value);

    /**
     * Convert camelCase to camel_case
     *
     * @param $str
     * @return mixed
     */
	public function toUnderscore($str);
}