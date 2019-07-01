<?php
namespace Netsilik\Sanitizer\Interfaces;

interface iSantizerPlugin
{
	/**
	 * @return array An error with error message, or an empty array if no errors occurred
	 */
	public function getErrors() : array;
	
	/**
	 * Get the last error that occurred, or null if no errors have occurred
	 *
	 * @return string|null
	 */
	public function getLastError() : ?string;
	
	/**
	 * @param string $data
	 * @param bool   $silent
	 *
	 * @return mixed
	 */
	public function sanitize(string $data, int $maxLength, bool $silent);
	
}
