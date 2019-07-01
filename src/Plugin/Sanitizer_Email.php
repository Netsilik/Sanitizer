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
 * Force data to only contain characters valid in an email address
 *
 * @return string
 */
class Sanitizer_Email extends AbstractSanitizer
{
	protected $_maxLength = 255;
	
	/**
	 * allowed chars left of the @ sign (RFC 2822):
	 * ! # $ % & ' * + - / = ? ^ _ ` { | } ~
	 * allowed characters right of the @ sign (RFC 1123):
	 * - .
	 * not allowed by RFC 1123 but endorced:
	 * _
	 *
	 * @var string $_regEx
	 */
	protected $_regEx = '/[^a-z0-9_!#$%&\'*+\\-\\/=?^`{\\|}~@\\.\\[\\]]/i';
}
