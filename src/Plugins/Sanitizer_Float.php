<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be of type floating point (also known as "floats", "doubles", "decimal", or "real numbers")
 *
 * @return int cleaned data
 */
class Sanitizer_Float extends AbstractSanitizer
{
	
	protected $_regEx = '/[^+\\-0-9\\.eE]/';
	
	public function sanitize($data, $silent, $maxLength = 0)
	{
		if (!$silent && preg_match($this->_regEx, $data)) {
			$this->_errors[] = 'Invalid characters encounterd in ' . $this->_getType() . ' data';
			
			return null;
		}
		
		return (float) preg_replace($this->_regEx, '', $data);
	}
}
