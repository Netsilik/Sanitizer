<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be valid hex string
 *
 * @return string
 */
class Sanitizer_Hex extends AbstractSanitizer
{
	protected $_regEx = '/[^0-9A-F]/i';
}
