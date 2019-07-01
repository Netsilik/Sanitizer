<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be valid fraction string (for example: 3/2)
 *
 * @return string
 */
class Sanitizer_FractionString extends AbstractSanitizer
{
	protected $_maxLength = 255;
	
	protected $regex      = '/([^0-9\\/\\-])/';
}
