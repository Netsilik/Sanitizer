<?php
namespace Netsilik\Lib\Sanitizer\Plugin;
/**
 * @package       Core
 * @version       1.77
 * @date          2012-07-14
 * @copyright (c) 2010-2012 Netslik (http://netsilik.nl)
 * @license       EUPL (European Union Public Licence, v.1.1)
 */

use Netsilik\Lib\Sanitizer\SanitizerPlugin;

/**
 * Force data to be of type integer
 *
 * @return int cleaned data
 */
class SanitizerPlugin_Int extends SanitizerPlugin
{
	protected $regEx = '/[^0-9\\-\\+]/';
	
	public function sanitize($data, $silent, $maxLength = 0)
	{
		$this->errorStr = '';
		if (!$silent && preg_match($this->regEx, $data)) {
			$this->errorStr = 'Invalid characters encounterd in ' . $this->getType() . ' data';
			
			return null;
		}
		
		return (int) preg_replace($this->regEx, '', $data);
	}
}
