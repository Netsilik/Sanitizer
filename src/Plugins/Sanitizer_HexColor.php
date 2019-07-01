<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be valid Hex color characters
 *
 * @return string
 */
class Sanitizer_HexColor extends AbstractSanitizer
{
	protected $_maxLength = 9;
	
	protected $_regEx     = '/[^0-9A-F#]/';
}
