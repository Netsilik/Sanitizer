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
 * Force data to only contain characters valid in an email address
 *
 * @return string
 */
class SanitizerPlugin_Email extends SanitizerPlugin
{
	// allowed chars left of the @ sign (RFC 2822):
	// ! # $ % & ' * + - / = ? ^ _ ` { | } ~
	//
	// allowed characters right of the @ sign (RFC 1123):
	// - .
	// not allowed by RFC 1123 but endorced:
	// _
	protected $_regEx = '/[^a-z0-9_!#$%&\'*+\\-\\/=?^`{\\|}~@\\.\\[\\]]/i';
}
