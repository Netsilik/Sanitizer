<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be of type integer
 *
 * @return int cleaned data
 */
class Sanitizer_Int extends AbstractSanitizer
{
	protected $_regEx = '/[^0-9\\-\\+]/';
	
	public function sanitize($data, $silent, $maxLength = 0)
	{
		if (!$silent && preg_match($this->_regEx, $data)) {
			$this->_errors[] = 'Invalid characters encounterd in ' . $this->_getType() . ' data';
			
			return null;
		}
		
		return (int) preg_replace($this->_regEx, '', $data);
	}
}
