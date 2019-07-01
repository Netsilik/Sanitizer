<?php
namespace Netsilik\Sanitizer\Plugins;

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
