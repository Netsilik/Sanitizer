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
 * Force data to be valid fraction string (for example: 3/2)
 *
 * @return string
 */
class SanitizerPlugin_FractionString extends SanitizerPlugin
{
	protected $regex      = '/([^0-9\\/\\-])/';
	
	protected $_maxLength = 255;
}
