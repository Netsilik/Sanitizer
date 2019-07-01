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
 * Force data to be valid fraction string (for example: 3/2)
 *
 * @return string
 */
class Sanitizer_FractionString extends AbstractSanitizer
{
	protected $_maxLength = 255;
	
	protected $regex      = '/([^0-9\\/\\-])/';
}
