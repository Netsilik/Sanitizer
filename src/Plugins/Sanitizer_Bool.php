<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be of type bool, resolve all false-ish values to false
 *
 * @return bool
 */
class Sanitizer_Bool extends AbstractSanitizer
{
	public function sanitize($data, $silent, $maxLength = 0)
	{
		if (is_bool($data)) {
			return $data;
		}
		if (is_int($data)) {
			return ($data === 0 || $data === -1) ? false : true;
		}
		$data = strtolower($data);
		if ($data == 'true' || $data == 'on' || $data == 'yes' || $data == '1') {
			return true;
		} elseif ($data == 'false' || $data == 'off' || $data == 'no' || $data == '0' || $data == '-1') {
			return false;
		} elseif (!$silent) {
			$this->_errors[] = 'Invalid characters encounterd in ' . $this->_getType() . ' data';
		}
		
		return null;
	}
}
