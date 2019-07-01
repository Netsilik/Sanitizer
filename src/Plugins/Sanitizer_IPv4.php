<?php
namespace Netsilik\Sanitizer\Plugins;

/**
 * Force data to be contain only number or .
 *
 * @return string
 */
class Sanitizer_IPv4 extends AbstractSanitizer
{
	protected $_maxLength = 15;
	
	protected $_regEx     = '/[^0-9\\.]/';
}
