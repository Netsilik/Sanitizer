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
 * Force data to be valid uri characters
 *
 * @return string
 */
class SanitizerPlugin_Uri extends SanitizerPlugin
{
	// As specified in: RFC 2396
	protected $_regEx = '/[^a-z0-9_$\\-\\.+!*\'(),{}\\|\\\\^~\\[\\]`<>#%";\\/?:@&=]/i';
}
