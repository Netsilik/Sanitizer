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
 * Force data to be valid base64 characters
 *
 * @return string
 */
class SanitizerPlugin_Base64 extends SanitizerPlugin
{
	protected $_regEx = '/[^0-9A-Z\\/+=]/i';
}
