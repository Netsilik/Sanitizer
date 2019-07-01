<?php
namespace Netsilik\Sanitizer\Plugins;

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
