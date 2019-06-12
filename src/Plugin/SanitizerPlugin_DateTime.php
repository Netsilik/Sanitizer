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
 * Force data to only contain characters valid in a date-time string
 *
 * @return string
 */
class SanitizerPlugin_DateTime extends SanitizerPlugin
{
	protected $regEx     = '/[^0-9\\-0x20:]/';
	
	protected $maxLength = 19;
}
