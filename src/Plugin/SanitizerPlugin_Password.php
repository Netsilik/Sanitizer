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
 * Force data to be valid user provided password string. (All ascii printable characters)
 *
 * @return string
 * @warning:
 * ** ******************************************************************* **
 * ** WARNING: The sanitized results are not 'safe', escape as nessecary! **
 * ** ******************************************************************* **
 */
class SanitizerPlugin_Password extends SanitizerPlugin_Utf8
{
	protected $maxLength = 256;
}
