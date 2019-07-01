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
 * Force data to be of type word (aphanum and _)
 *
 * @return string
 */
class Sanitizer_Word extends AbstractSanitizer
{
	protected $_regEx = '/[^a-z0-9_]/i';
}
