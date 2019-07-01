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
 * Force data to be contain only number or .
 *
 * @return string
 */
class Sanitizer_IPv4 extends AbstractSanitizer
{
	protected $_maxLength = 15;
	
	protected $_regEx = '/[^0-9\\.]/';
}
