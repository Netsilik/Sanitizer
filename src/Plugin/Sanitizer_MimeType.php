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
 * Force data to be valid mimetype string
 *
 * @return string
 */
class Sanitizer_MimeType extends AbstractSanitizer
{
	protected $_maxLength = 64;
	
	protected $_regEx     = '/[^0-9a-z\\/]/i';
}
