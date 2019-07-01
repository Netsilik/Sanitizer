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
 * Force data to be valid user provided password string. (All utf-8 printable characters)
 *
 * @return string
 */
class Sanitizer_Password extends Sanitizer_Utf8
{
	protected $_maxLength = 256;
}
