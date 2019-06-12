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
 * Force data to be valid hex 32 character long hexadecimal number
 *
 * @return string
 * @note zero left padded up 32 characters
 */
class SanitizerPlugin_Md5 extends SanitizerPlugin
{
	protected $regEx       = '/[^0-9A-F]/i';
	
	protected $maxLength   = 32;
	
	protected $forceLength = true;
}
