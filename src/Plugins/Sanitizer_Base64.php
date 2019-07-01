<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be valid base64 characters
 *
 * @return string
 */
class Sanitizer_Base64 extends AbstractSanitizer
{
	protected $_regEx = '/[^0-9A-Z\\/+=]/i';
}
