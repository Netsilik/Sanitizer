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
 * Force data to be valid 6-bit Session Identifier string
 *
 * In PHP > 5.3.0 it is possible to specify any of the algorithms provided by the hash extension (if it is available), like sha512 or whirlpool.
 * This would mean that the 40 characters limit with 4bit encoding is to short. (40 characters is for SHA-1, 32 characters for MD5)
 *
 * @return string
 */
class SanitizerPlugin_Session6bitsId extends SanitizerPlugin
{
	protected $_maxLength = 27;
	
	protected $_regEx     = '/[^0-9A-Z\\-,]/i';
}
