<?php
namespace Netsilik\Sanitizer\Plugin;
/**
 * @package       Core
 * @version       1.77
 * @date          2012-07-14
 * @copyright (c) 2010-2012 Netslik (http://netsilik.nl)
 * @license       EUPL (European Union Public Licence, v.1.1)
 */

use Netsilik\Sanitizer\Plugin\AbstractSanitizer;

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
		if ($data == 'true' || $data == '1') {
			return true;
		} elseif ($data == 'false' || $data == '0' || $data == '-1') {
			return false;
		} elseif (!$silent) {
			$this->_errors[] = 'Invalid characters encounterd in ' . $this->_getType() . ' data';
		}
		
		return null;
	}
}
